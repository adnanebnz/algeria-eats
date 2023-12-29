<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ConsumerController extends Controller
{
    public function ordersIndex()
    {
        return response()->json([
            'orders' => auth()->user()->orders,
        ]);
    }

    public function ordersShow($order)
    {
        return response()->json([
            'order' => auth()->user()->orders->findOrFail($order),
        ]);
    }
}
