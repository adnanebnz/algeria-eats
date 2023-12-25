<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Review;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CommentForm extends Component
{
    public $product;

    public $title;

    public $comment;

    public $rating;

    public function render()
    {
        return view('livewire.comment-form');
    }

    public function store()
    {
        //check if user has already bought this product
        $isPurchased = Order::where('buyer_id', auth()->user()->id)
            ->whereHas('orderItems', function ($query) {
                $query->where('product_id', $this->product->id);
            })
            ->first();

        if ($isPurchased === null) {
            Alert::error('Erreur', "Vous n'avez pas acheté ce produit");

            return redirect()->route('product.show', $this->product);
        } else {
            $data = $this->validate([
                'title' => 'required|min:3',
                'comment' => 'required|min:3',
                'rating' => 'required|numeric|min:1|max:5',
            ]);

            $product = $this->product;

            $review = Review::where('product_id', $product->id)
                ->where('user_id', auth()->user()->id)
                ->first();
            if ($review !== null) {
                Alert::error('Erreur', 'Vous avez déja commenté ce produit');

                return redirect()->route('product.show', $product);
            } else {
                Review::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'title' => $data['title'],
                    'comment' => $data['comment'],
                    'rating' => $data['rating'],
                ]);

                $product->update([
                    'rating' => $product->reviews->avg('rating'),
                ]);

                $this->dispatch('reviewAdded');

                Alert::success(
                    'Success',
                    'Votre commentaire a été ajouté avec succès'
                );
                $this->reset();

                return redirect()->route('product.show', $product);
            }
        }
    }
}
