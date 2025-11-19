<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Item;
use App\Models\Outgoing;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ========================
    // 1. TAMPILKAN SEMUA PESANAN
    // ========================
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    // ========================
    // 2. FORM BUAT PESANAN
    // ========================
    public function create()
    {
        $products = Product::with('item', 'category')->get();
        return view('orders.create', compact('products'));
    }

    // ========================
    // 3. SIMPAN PESANAN BARU
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'products' => 'required|array',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'order_date' => $request->order_date ?? now(),
            'total_price' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        foreach ($request->products as $product_id => $data) {
            if (!isset($data['selected']) || empty($data['quantity']) || $data['quantity'] <= 0) continue;

            $product = Product::findOrFail($product_id);
            $quantity = (int) $data['quantity'];
            $price = $product->price * $quantity;

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);

            // Kurangi stok produk
            $product->quantity -= $quantity;
            $product->save();

            // Kurangi stok item
            $item = Item::where('name', $product->name)->first();
            if ($item) {
                $item->quantity -= $quantity;
                $item->save();

                Outgoing::create([
                    'item_name' => $item->name,
                    'quantity' => $quantity,
                    'description' => 'Barang keluar untuk pesanan pelanggan: ' . $request->customer_name,
                ]);
            }

            $total += $price;
        }

        $order->update(['total_price' => $total]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat dan stok diperbarui.');
    }

    // ========================
    // 4. FORM EDIT PESANAN (MULTI PRODUK)
    // ========================
    public function edit($id)
    {
        $order = Order::with('products')->findOrFail($id);
        $products = Product::with('item', 'category')->get();
        return view('orders.edit', compact('order', 'products'));
    }

    // ========================
    // 5. UPDATE PESANAN (MULTI PRODUK)
    // ========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = Order::findOrFail($id);
        $total = 0;

        // Ambil semua produk lama di order_product
        $existingProducts = OrderProduct::where('order_id', $order->id)->get()->keyBy('product_id');

        foreach ($request->products as $product_id => $data) {
            $product = Product::findOrFail($product_id);
            $quantity = (int) ($data['quantity'] ?? 0);
            $selected = isset($data['selected']);

            // Jika tidak dipilih, hapus dari order
            if (!$selected) {
                if (isset($existingProducts[$product_id])) {
                    $oldQuantity = $existingProducts[$product_id]->quantity;

                    // Kembalikan stok produk & item
                    $product->quantity += $oldQuantity;
                    $product->save();

                    $item = Item::where('name', $product->name)->first();
                    if ($item) {
                        $item->quantity += $oldQuantity;
                        $item->save();
                    }

                    // Hapus dari pivot
                    $existingProducts[$product_id]->delete();
                }
                continue;
            }

            // Jika produk baru ditambahkan
            if (!isset($existingProducts[$product_id])) {
                if ($quantity > 0) {
                    $price = $product->price * $quantity;

                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $product->quantity -= $quantity;
                    $product->save();

                    $item = Item::where('name', $product->name)->first();
                    if ($item) {
                        $item->quantity -= $quantity;
                        $item->save();

                        Outgoing::create([
                            'item_name' => $item->name,
                            'quantity' => $quantity,
                            'description' => 'Produk baru ditambahkan dalam pesanan: ' . $order->customer_name,
                        ]);
                    }

                    $total += $price;
                }
            } else {
                // Produk sudah ada → cek selisih quantity
                $orderProduct = $existingProducts[$product_id];
                $difference = $quantity - $orderProduct->quantity;

                if ($quantity <= 0) {
                    // hapus produk
                    $orderProduct->delete();
                    continue;
                }

                // Update pivot
                $orderProduct->update([
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ]);

                // Update stok
                $product->quantity -= $difference;
                $product->save();

                $item = Item::where('name', $product->name)->first();
                if ($item) {
                    $item->quantity -= $difference;
                    $item->save();
                }

                // Catat bila ada tambahan quantity
                if ($difference > 0) {
                    Outgoing::create([
                        'item_name' => $product->name,
                        'quantity' => $difference,
                        'description' => 'Penyesuaian pesanan pelanggan: ' . $order->customer_name,
                    ]);
                }

                $total += $product->price * $quantity;
            }
        }

        $order->update(['total_price' => $total]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // ========================
    // 6. HAPUS PESANAN
    // ========================
    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {
            $quantity = $product->pivot->quantity;

            $product->quantity += $quantity;
            $product->save();

            $item = Item::where('name', $product->name)->first();
            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            }
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan dihapus dan stok dikembalikan.');
    }
}
