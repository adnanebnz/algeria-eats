<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component
{
    public $products;

    public function render()
    {
        $this->products = Product::where('rating', '>=', 4)->take(3)->get();

        return view('livewire.featured-products', [
            'products' => $this->products,
        ]);
    }
}
