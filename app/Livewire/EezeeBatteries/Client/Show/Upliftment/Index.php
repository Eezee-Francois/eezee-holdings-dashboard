<?php

namespace App\Livewire\EezeeBatteries\Client\Show\Upliftment;

use Auth;

use App\Models\EezeeBatteries\Upliftment;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $client;
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
        $upliftments = Upliftment::where(function($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('client_name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%')
                    ->orWhere('province', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(30);

        return view('livewire.eezee-batteries.client.show.upliftment.index', compact('upliftments'));
    }
}
