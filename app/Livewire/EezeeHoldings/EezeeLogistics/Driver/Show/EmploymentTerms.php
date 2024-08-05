<?php

namespace App\Livewire\EezeeHoldings\EezeeLogistics\Driver\Show;

use Auth;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\EezeeHoldings\EezeeLogistics\Day;
use App\Models\EezeeHoldings\EezeeLogistics\Term;

use Livewire\Component;
use Livewire\WithPagination;

class EmploymentTerms extends Component
{
    use WithPagination;

	public $search;
	public $sortField = 'start_date';
	public $sortDirection = 'asc';
	public $driver;
	public $start_date;
	public $end_date;

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

	public function saveEmploymentTerm()
	{
		$term = $this->validate([
			'start_date' => 'required',
			'end_date' => 'required',
		]);

		$start_date = Carbon::parse($this->start_date)->format('Y-m-d');
		$end_date = Carbon::parse($this->end_date)->format('Y-m-d');

		$exists = Day::where('driver_id', $this->driver->id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->get();

		if($exists->contains('date', '>=', $start_date) OR $exists->contains('date', '<=', $end_date))
        {
            session()->flash('already_employed');
            
        } else {
			$term = new Term;

                $term->user_id = Auth::user()->id;
                $term->driver_id = $this->driver->id;
                $term->start_date = $start_date;
                $term->end_date = $end_date;

            $term->save();

            $period = CarbonPeriod::create($start_date, $end_date);
            foreach ($period as $date) {

                $day = new Day;
                
                    $day->user_id = Auth::user()->id;
	                $day->term_id = $term->id;
	                $day->driver_id = $this->driver->id;
	                $day->date = $date->format('Y/m/d');

                $day->save();
            }

            session()->flash('term_saved'); 
        }
	}

    public function render()
    {
    	$employment_terms = Term::where('driver_id', $this->driver->id)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        return view('livewire.eezee-holdings.eezee-logistics.driver.show.employment-terms', compact('employment_terms'));
    }
}
