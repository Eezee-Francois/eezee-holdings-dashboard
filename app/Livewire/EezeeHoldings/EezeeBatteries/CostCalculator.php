<?php

namespace App\Livewire\EezeeBatteries;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CostCalculator extends Component
{
    public $lat;
    public $lng;
    public $weight;
    public $totalPotentialCost;

    public function calculateCost()
    {
        $warehouseLat = -26.1883;
        $warehouseLng = 28.3208;

        $earthRadius = 6371; // Radius of the earth in km

        $latDistance = deg2rad($warehouseLat - $this->lat);
        $lonDistance = deg2rad($warehouseLng - $this->lng);

        $a = sin($latDistance / 2) * sin($latDistance / 2) +
            cos(deg2rad($warehouseLat)) * cos(deg2rad($this->lat)) *
            sin($lonDistance / 2) * sin($lonDistance / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        $totalDistance = $distance * 2;
        $pricePerLiter = $totalDistance / 4;
        $totalCost = $pricePerLiter * 23;
        $costPerKg = $totalCost / $this->weight;

        $this->totalPotentialCost = 17.75 - $costPerKg;
    }

    public function render()
    {
        return view('livewire.eezee-holdings.eezee-batteries.cost-calculator');
    }
}
