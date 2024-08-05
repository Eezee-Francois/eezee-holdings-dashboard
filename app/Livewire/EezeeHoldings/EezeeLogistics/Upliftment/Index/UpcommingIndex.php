<?php

namespace App\Livewire\EezeeHoldings\EezeeLogistics\Upliftment\Index;

use Auth;

use App\Models\EezeeHoldings\EezeeBatteries\Upliftment;

use Livewire\Component;
use Livewire\WithPagination;

class UpcommingIndex extends Component
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
        $upliftments = Upliftment::where('completed', 'No')->where(function($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('client_name', 'like', '%' . $this->search . '%')
                    ->orWhere('company_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(30);

        return view('livewire.eezee-holdings.eezee-logistics.upliftment.index.upcomming-index', compact('upliftments'));
    }
}
