<?php

namespace App\Livewire;

use App\Models\Artisan;
use App\Models\Consumer;
use App\Models\DeliveryMan;
use App\Models\User;
use Livewire\Component;

class UserStatistic extends Component
{
    public function render()
    {
        $users = User::all();
        $artisans = Artisan::all();
        $deliveryMans = DeliveryMan::all();
        $consumer = Consumer::all();

        return view('livewire.user-statistic', [
            'users' => $users->count(),
            'artisans' => $artisans->count(),
            'deliveryMans' => $deliveryMans->count(),
            'consumer' => $consumer->count(),
        ]);
    }
}
