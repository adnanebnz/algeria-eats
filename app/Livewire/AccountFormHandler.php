<?php

namespace App\Livewire;

use Livewire\Component;

class AccountFormHandler extends Component
{
    public $selectedAccountType = 'consumer';

    public function render()
    {
        return view('livewire.account-form-handler');
    }

    public function updatedSelectedAccountType($value)
    {
        $this->selectedAccountType = $value;
    }
}
