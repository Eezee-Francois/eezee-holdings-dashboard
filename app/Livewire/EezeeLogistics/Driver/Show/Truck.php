<?php

namespace App\Livewire\EezeeLogistics\Driver\Show;

use Livewire\Component;

class Truck extends Component
{
    public $driver;
	public $driver_id;
    public $truck_id;
	public $trucks;

	public function addTruck()
	{
		$truck = $this->validate([
			'truck_id' => 'required',
		]);

		if($this->truck_id === 'All Trucks'){
			foreach($this->trucks as $truck){
	            if(!$truck->drivers->contains($this->driver->id)){
	                $truck->drivers()->attach($this->driver->id);
	                session()->flash('all_trucks_added');
	            }
	        }
		} else {
			$truck = \App\Models\EezeeLogistics\Truck::find($this->truck_id);
			if($truck->drivers->contains($this->driver->id)){
				session()->flash('exists');
			} else {
				$truck->drivers()->attach($this->driver->id);
				session()->flash('truck_added');
				$this->render();
			}
		}
	}

	public function removeTruck($truck_id)
	{
		$this->truck_id = $truck_id;
		$truck = \App\Models\EezeeLogistics\Truck::find($this->truck_id);

		if($truck->drivers->contains($this->driver->id)){
			$truck->drivers()->detach($this->driver->id);
			session()->flash('truck_removed');
		}
	}
	
    public function render()
    {
        return view('livewire.eezee-logistics.driver.show.truck');
    }
}
