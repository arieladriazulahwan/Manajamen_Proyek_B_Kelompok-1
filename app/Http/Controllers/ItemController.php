<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $incomings = \App\Models\Incoming::all();
        return view('items.index', compact('incomings'));
    }
}
