<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class SingleProduct extends Component
{
    public $product;

    public $quantity = 1;

    public $feedbackMessage;

    public $feedbackMessageType;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function updatedQuantity($value)
    {
        // Ensure the quantity is a positive integer
        $this->quantity = max(1, intval($value));
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (Auth::check()) {
            if (
                Cart::where('product_id', $this->product->id)
                    ->where('user_id', auth()->user()->id)
                    ->exists()
            ) {
                $this->feedbackMessage = 'Produit déja dans le panier';
                $this->feedbackMessageType = 'error';
                $product = $this->product;
                Alert::error('Erreur', 'Produit déja dans le panier');

                return redirect()->route('product.show', $product);
            } else {
                Cart::create([
                    'product_id' => $this->product->id,
                    'user_id' => auth()->user()->id,
                    'quantity' => $this->quantity,
                ]);
                $this->dispatch('cartAddedUpdated');
                $this->quantity = 1;
                $this->feedbackMessage = 'Produit ajouté au panier';
                $this->feedbackMessageType = 'success';
                $product = $this->product;
                Alert::success('Success', 'Produit ajouté au panier');

                return redirect()->route('product.show', $product);
            }
        } else {
            return redirect()->route('login');
        }
    }

    #[On('closeFeedbackMessage')]
    public function closeFeedbackMessage()
    {
        $this->feedbackMessage = '';
        $this->feedbackMessageType = '';
    }

    public function render()
    {
        return view('livewire.single-product');
    }
}
