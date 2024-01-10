<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPage extends Component
{
    use WithPagination;

    public $search;

    public $artisan;

    public $artisanRating;

    public $productType;

    public $productRating;

    public $filters;

    public $orderDirection = 'desc';

    public function mount()
    {
        $this->filters = [
            'search' => $this->search,
            'artisan' => $this->artisan,
            'artisanRating' => $this->artisanRating,
            'productRating' => $this->productRating,
            'productType' => $this->productType,
        ];
    }

    public function render()
    {
        return view('livewire.products-page', [
            'products' => Product::select(
                'id',
                'nom',
                'rating',
                'prix',
                'categorie',
                'images'
            )
                ->filters($this->filters)
                ->orderBy('prix', $this->orderDirection)
                ->paginate(8),
        ]);
    }

    public function applyFilters()
    {
        $this->filters = [
            'search' => $this->search,
            'artisan' => $this->artisan,
            'artisanRating' => $this->artisanRating,
            'productRating' => $this->productRating,
            'productType' => $this->productType,
        ];
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'artisan',
            'artisanRating',
            'productRating',
            'productType',
        ]);
        $this->applyFilters();
        $this->resetPage();
    }

    public function store($id)
    {
        $this->dispatch('cartAdded', $id);
    }
}
