<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Outgoing;
use App\Models\Item;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

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
}
