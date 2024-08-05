<?php

namespace App\Livewire\EezeeHoldings\EezeeLogistics\Truck\Show;

use Auth;

use Carbon\Carbon;

use App\Models\EezeeHoldings\EezeeLogistics\Truck;

use Livewire\Component;

use Illuminate\Support\Facades\Crypt;

class Details extends Component
{
    public $truck;
    public $user_id;
	public $name;
	public $registration;
	public $weight;
    public $weight_with_unit;

	public function mount(Truck $truck)
	{
		$this->truck = $truck;
		$this->name = $truck->name;
		$this->registration = $truck->registration;
		$this->weight = $truck->weight;
        $this->weight_with_unit = $this->weight . ' Kg';
	}

    public function updatedWeightWithUnit($value)
    {
        $this->weight = intval(preg_replace('/[^0-9]/', '', $value));
        $this->weight_with_unit = $this->weight . ' Kg';
    }

	public function saveTruckDetails()
	{
		$this->validate([
            'name' => 'required|string|max:255',
            'registration' => 'required|string|max:255',
            'weight' => 'required|numeric|max:255',
        ]);

        $this->truck->update([
            'user_id' => Auth::user()->id,
            'name' => $this->name,
            'registration' => $this->registration,
            'weight' => $this->weight,
        ]);

		session()->flash('truck_details_saved');

	}

    public function render()
    {
        return view('livewire.eezee-holdings.eezee-logistics.truck.show.details');
    }
}
