<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Item;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index()
    {
        $incomings = Incoming::latest()->get();
        $outgoings = Outgoing::latest()->get();
        $items = Item::latest()->get();
        $categories = Category::all();
        $products = Product::with('category')->get();
        $orders = Order::with('products')->get();

        return view('reports.index', compact(
            'incomings',
            'outgoings',
            'items',
            'categories', // <- ini sudah benar
            'products',
            'orders',
        ));
    }

    public function exportPdf($type = 'all')
    {
        $incomings = Incoming::latest()->get();
        $outgoings = Outgoing::latest()->get();
        $items = Item::latest()->get();
        $categories = Category::all();
        $products = Product::with('category')->get();
        $orders = Order::with('products')->get();

        $data = compact('incomings', 'outgoings', 'items', 'categories', 'products', 'orders', 'type');

        $pdf = PDF::loadView('reports.pdf', $data);
        $filename = match($type) {
            'incomings' => 'Laporan-Barang-Masuk.pdf',
            'outgoings' => 'Laporan-Barang-Keluar.pdf',
            'items' => 'Laporan-Stok-Barang.pdf',
            'products' => 'Laporan-Produk.pdf',
            'orders' => 'Laporan-Pesanan.pdf',
            default => 'Laporan-Gudang-Lengkap.pdf'
        };

        

        return $pdf->download($filename);
    }
}
