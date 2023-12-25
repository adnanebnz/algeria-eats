<?php

namespace App\Livewire;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\UserReview;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class UserReviewForm extends Component
{
    public $user;

    public $title;

    public $review;

    public $rating;

    public function render()
    {
        return view('livewire.user-review-form');
    }

    public function store()
    {
        // ONLY USERS WHO HAVE BOUGHT FROM THIS USER CAN REVIEW HIM
        $purchasedFromThisUser = Order::where('buyer_id', auth()->user()->id)
            ->whereHas('orderItems', function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('artisan_id', $this->user->id);
                });
            })
            ->first();

        //DEALED WITH THIS DELIVERY MAN AS A BUYER OR ARTISAN
        $dealedWithThisDeliveryMan = Delivery::whereHas('order', function (
            $query
        ) {
            $query
                ->where('buyer_id', auth()->user()->id)
                ->orWhere('artisan_id', auth()->user()->id);
        })
            ->whereHas('deliveryMan', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->first();

        if (
            $purchasedFromThisUser === null &&
            $dealedWithThisDeliveryMan === null
        ) {
            Alert::error(
                'Erreur',
                "Vous n'avez rien acheté ou n'avez rien eu avec cet utilisateur"
            );

            return redirect()->route('profile', $this->user);
        } else {
            $data = $this->validate([
                'title' => 'required|min:3',
                'review' => 'required|min:3',
                'rating' => 'required|numeric|min:1|max:5',
            ]);

            $user = $this->user;

            $review = UserReview::where('user_id', $user->id)
                ->where('reviewer_id', auth()->id())
                ->first();
            if ($review) {
                Alert::error('Erreur', 'Vous avez déja commenté ce profile');

                return redirect()->route('profile', $user);
            } else {
                UserReview::create([
                    'user_id' => $user->id,
                    'reviewer_id' => auth()->id(),
                    'title' => $data['title'],
                    'review' => $data['review'],
                    'rating' => $data['rating'],
                ]);

                $user->update([
                    'rating' => $user->reviews->avg('rating'),
                ]);

                $this->dispatch('userReviewAdded');

                Alert::success(
                    'Success',
                    'Votre commentaire a été ajouté avec succès'
                );
                $this->reset();

                return redirect()->route('profile', $user);
            }
        }
    }
}
