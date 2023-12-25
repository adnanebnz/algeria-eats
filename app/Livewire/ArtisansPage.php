<?php

namespace App\Livewire;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Models\Artisan;
use Livewire\Component;
use Livewire\WithPagination;

class ArtisansPage extends Component
{
    use WithPagination;

    public $search;

    public $artisanWilaya;

    public $artisanRating;

    public $typeService;

    public $filters;

    public function mount()
    {
        $this->filters = [
            'search' => $this->search,
            'artisanRating' => $this->artisanRating,
            'artisanWilaya' => $this->artisanWilaya,
            'typeService' => $this->typeService,
        ];
    }

    public function render()
    {
        $wilayas = AlgerianCitiesFacade::getAllWilayas();
        $artisans = Artisan::select('user_id', 'rating', 'type_service')
            ->filters($this->filters)
            ->orderBy('rating', 'desc')
            ->paginate(10);

        return view('livewire.artisans-page', [
            'artisans' => $artisans,
            'wilayas' => $wilayas,
        ]);
    }

    public function applyFilters()
    {
        $this->filters = [
            'search' => $this->search,
            'artisanWilaya' => $this->artisanWilaya,
            'artisanRating' => $this->artisanRating,
            'typeService' => $this->typeService,
        ];
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'artisanWilaya',
            'artisanRating',
            'typeService',
        ]);

        $this->applyFilters();
        $this->resetPage();
    }
}
