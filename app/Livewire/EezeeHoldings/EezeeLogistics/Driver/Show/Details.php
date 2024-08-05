<?php

namespace App\Livewire\EezeeHoldings\EezeeLogistics\Driver\Show;

use Auth;

use Carbon\Carbon;

use App\Models\EezeeHoldings\EezeeLogistics\Driver;

use Livewire\Component;

use Illuminate\Support\Facades\Crypt;

class Details extends Component
{
    public $driver;
    public $user_id;
	public $first_name;
	public $last_name;
	public $drivers_license;

	public function mount(Driver $driver)
	{
		$this->driver = $driver;
		$this->first_name = $driver->first_name;
		$this->last_name = $driver->last_name;
		$this->drivers_license = $driver->drivers_license;
	}

	public function saveDriverDetails()
	{
		$this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'drivers_license' => 'required|string|max:255',
        ]);

        $this->driver->update([
            'user_id' => Auth::user()->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'drivers_license' => $this->drivers_license,
        ]);

		session()->flash('driver_details_saved');

	}

    public function render()
    {
        return view('livewire.eezee-holdings.eezee-logistics.driver.show.details');
    }
}
