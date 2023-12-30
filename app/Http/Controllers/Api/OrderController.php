<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'orders' => auth()->user()->orders()->with(['products', 'deliveryMan.user'])->get(),
        ]);
    }

    public function show(Order $order)
    {
        return response()->json([
            'order' => $order->with(['products', 'deliveryMan.user'])->first(),
        ]);
    }
}
