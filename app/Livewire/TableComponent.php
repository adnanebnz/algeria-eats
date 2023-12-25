<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class TableComponent extends Component
{
    public $product;

    use WithPagination;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $orders = Order::whereHas('orderItems', function ($query) {
            $query->where('product_id', $this->product->id);
        })->paginate(10);

        return view('livewire.table-component', [
            'orders' => $orders,
        ]);
    }
}
