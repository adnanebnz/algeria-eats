<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CommentComponent extends Component
{
    public $product;

    public $comments;

    public function render()
    {
        $this->comments = $this->product
            ->reviews()
            ->latest()
            ->get();

        return view('livewire.comment-component', [
            'comments' => $this->comments,
        ]);
    }

    #[On('reviewAdded')]
    public function reviewAdded()
    {
        $this->comments = $this->product
            ->reviews()
            ->latest()
            ->get();
    }
}
