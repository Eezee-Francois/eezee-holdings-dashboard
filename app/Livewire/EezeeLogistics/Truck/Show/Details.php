<?php

namespace App\Livewire\EezeeLogistics\Truck\Show;

use Auth;

use Carbon\Carbon;

use App\Models\EezeeLogistics\Truck;

use Livewire\Component;

use Illuminate\Support\Facades\Crypt;

class Details extends Component
{
    public $truck;
    public $user_id;
	public $name;
	public $registration;
	public $size;
    public $size_with_unit;

	public function mount(Truck $truck)
	{
		$this->truck = $truck;
		$this->name = $truck->name;
		$this->registration = $truck->registration;
		$this->size = $truck->size;
        $this->size_with_unit = $this->size . ' Tons';
	}

    public function updatedSizeWithUnit($value)
    {
        $this->size = intval(preg_replace('/[^0-9]/', '', $value));
        $this->size_with_unit = $this->size . ' Tons';
    }

	public function saveTruckDetails()
	{
		$this->validate([
            'name' => 'required|string|max:255',
            'registration' => 'required|string|max:255',
            'size' => 'required|numeric|max:255',
        ]);

        $this->truck->update([
            'user_id' => Auth::user()->id,
            'name' => $this->name,
            'registration' => $this->registration,
            'size' => $this->size,
        ]);

		session()->flash('truck_details_saved');

	}

    public function render()
    {
        return view('livewire.eezee-logistics.truck.show.details');
    }
}
