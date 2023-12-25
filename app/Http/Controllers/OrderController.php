<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $total = 0;
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->product->prix * $cartItem->quantity;
        }

        return view('cart.checkout', compact('total', 'cartItems'));
    }
}
