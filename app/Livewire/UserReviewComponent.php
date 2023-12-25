<?php

namespace App\Livewire;

use App\Models\UserReview;
use Livewire\Attributes\On;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $user;

    public $comments;

    public function render()
    {
        $this->comments = UserReview::where('user_id', $this->user->id)
            ->latest()
            ->get();

        return view('livewire.user-review-component');
    }

    #[On('userReviewAdded')]
    public function userReviewAdded()
    {
        $this->comments = $this->product
            ->reviews()
            ->latest()
            ->get();
    }
}
