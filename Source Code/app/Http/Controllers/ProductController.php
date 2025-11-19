<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Item; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('products.create', compact('items', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Item::find($request->item_id);

        Product::create([
            'item_id' => $item->id,
            'category_id' => $request->category_id,
            'name' => $item->name,
            'quantity' => $item->quantity, // ambil dari item
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $items = Item::all();

    return view('products.edit', compact('product', 'categories', 'items'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
    ]);

    $product = Product::findOrFail($id);
    $item = Item::findOrFail($request->item_id);

    // 🔹 Update data produk
    $product->update([
        'name' => $item->name,
        'category_id' => $request->category_id,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    // 🔹 Sinkronkan stok di tabel Item
    $item->update([
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui dan stok item disinkron.');
}

    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }
}
