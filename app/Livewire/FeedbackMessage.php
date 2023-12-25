<?php

namespace App\Livewire;

use Livewire\Component;

class FeedbackMessage extends Component
{
    public $message = '';

    public $type = '';

    public function mount($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function closeFeedbackMessage()
    {
        $this->message = '';
        $this->type = '';
        $this->dispatch('closeFeedbackMessage');
    }

    public function render()
    {
        return view('livewire.feedback-message');
    }
}
