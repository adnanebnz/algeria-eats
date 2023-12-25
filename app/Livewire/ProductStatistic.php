<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class ProductStatistic extends Component
{
    public function render()
    {
        $products = Product::all();
        $orders = Order::all();
        $messages = Contact::all();

        return view('livewire.product-statistic', [
            'products' => $products->count(),
            'orders' => $orders->count(),
            'messages' => $messages->count(),
        ]);
    }
}
