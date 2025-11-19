<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = \App\Models\Item::all();
        return view('items.index', compact('items'));
    }

}
