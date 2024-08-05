<?php

namespace App\Livewire\EezeeHoldings\EezeeBatteries\Stock\StockCode;

use Auth;

use App\Models\EezeeHoldings\EezeeBatteries\StockCode;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $client;
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
        $stock_codes = StockCode::where(function($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('stock_code', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(30);

        return view('livewire.eezee-holdings.eezee-batteries.stock.stock-code.index', compact('stock_codes'));
    }
}
