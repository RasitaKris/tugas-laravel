<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with('items.product')
                      ->findOrFail($id);

        return view('order.show', compact('order'));
    }
}
