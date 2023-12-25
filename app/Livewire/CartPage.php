<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartPage extends Component
{
    public $cartItems;

    public $totalPrice;

    public $quantity = 1;

    public function increaseQuantity($productId)
    {
        $cart = Cart::where('product_id', $productId)
            ->where('user_id', auth()->user()->id)
            ->first();
        $cart->quantity += 1;
        $cart->save();
    }

    public function decreaseQuantity($productId)
    {

        $cart = Cart::where('product_id', $productId)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
        }
        $cart->save();
        $this->dispatch('cartAddedUpdated');
    }

    public function remove($productId)
    {

        Cart::where('product_id', $productId)
            ->where('user_id', auth()->user()->id)
            ->delete();
    }

    #[On('cartAddedUpdated')]
    public function updateCart()
    {
        $this->cartItems = Cart::where('user_id', auth()->user()->id)->get();

        return $this->render();
    }

    public function render()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::where(
                'user_id',
                auth()->user()->id
            )->get();

            $this->totalPrice = 0;
            foreach ($this->cartItems as $item) {
                $this->totalPrice += $item->product->prix * $item->quantity;
            }
        }

        return view('livewire.cart-page', [
            'cartItems' => $this->cartItems,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}
