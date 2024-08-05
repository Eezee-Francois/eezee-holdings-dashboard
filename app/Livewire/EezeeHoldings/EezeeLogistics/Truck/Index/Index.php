<?php

namespace App\Livewire\EezeeHoldings\EezeeLogistics\Truck\Index;

use Auth;

use App\Models\EezeeHoldings\EezeeLogistics\Truck;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $trucks = Truck::where(function($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('registration', 'like', '%' . $this->search . '%')
                    ->orWhere('weight', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(30);

        return view('livewire.eezee-holdings.eezee-logistics.truck.index.index', compact('trucks'));
    }
}
