<?php

namespace App\Livewire\EezeeHoldings\EezeeBatteries\Client\Show\Upliftment;

use DB;
use PDF;
use Auth;
use File;
use Mail;
use finfo;
use Redirect;

use Carbon\Carbon;

use App\Models\EezeeHoldings\PurchaseOrder;

use App\Models\EezeeHoldings\EezeeBatteries\Client;
use App\Models\EezeeHoldings\EezeeBatteries\Upliftment;

use App\Models\EezeeHoldings\EezeeLogistics\Day;
use App\Models\EezeeHoldings\EezeeLogistics\Term;
use App\Models\EezeeHoldings\EezeeLogistics\Truck;
use App\Models\EezeeHoldings\EezeeLogistics\Driver;

// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Notification;

use Livewire\Component;

class BookUpliftment extends Component
{
    public $upliftment;
    public $driver_id;

    public $trucks;
    public $days;
    public $drivers;
    public $driverIds;
    public $driverDistance;

    public $date;
    public $end_time;
    public $duration;
    public $travelTime;
    // public $upliftmentType;

    public $selectedTime;
	public $selectedDriver;
	public $selectedDriverId;
	public $selectedTruckId;
	public $selectedDayId;
	public $selectedDate;

	public $selectedUpliftmentConsultant;
	public $selectedUpliftmentAddress;
	public $selectedUpliftmentId;

    public function actualMount()
    {
        $this->trucks = Truck::where('weight', '>=', $this->upliftment->weight)->get();

        $latitude = $this->upliftment->lat;
        $longitude = $this->upliftment->lng;

        // Calculate distances and get active drivers
        $this->drivers = Driver::selectRaw('id,
            active,
            ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance', [
                $latitude, 
                $longitude, 
                $latitude
            ])
            ->having('active', 'Yes')
            ->get();

        $drivers = $this->drivers->pluck('distance', 'id');

        $this->driverIds = $drivers->keys()->toArray();
        $this->driverDistance = $drivers->toArray();

        // Prepare driver IDs for ordering
        if (!empty($this->driverIds)) {
            $driverIdsString = implode(',', $this->driverIds);

            // Retrieve days based on driver IDs and date
            $this->days = Day::whereIn('driver_id', $this->driverIds)
                ->where('date', $this->date)
                ->orderByRaw("FIELD(driver_id, $driverIdsString)")
                ->get();
        } else {
            // Handle the case where no drivers are found
            $this->days = collect();
        }
    }

	public function selectTime($time, $driver, $driverId, $truckId, $dayId, $distance)
	{
		$this->selectedTime = $time;
		$this->selectedDriver = $driver;
		$this->selectedDriverId = $driverId;
		$this->selectedTruckId = $truckId;
		$this->selectedDayId = $dayId;
		$this->selectedDate = $this->date;
        $this->distance = $distance;

        if($distance <= 10){
            $this->travelTime = 15;
        } elseif($distance <= 20){
            $this->travelTime = 20;
        } elseif($distance <= 30){
            $this->travelTime = 30;
        } elseif($distance <= 60){
            $this->travelTime = 40;
        } elseif($distance > 60){
            $this->travelTime = 60;
        }

        $this->dispatch('openUpliftmentModal');
	}

	public function viewBookedUpliftment($id)
	{
		$upliftment = Upliftment::find($id);

		$this->selectedUpliftmentAddress = $upliftment->address;
		$this->selectedUpliftmentConsultant = $upliftment->consultant_name;
		$this->selectedUpliftmentId = $upliftment->id;

		$this->dispatch('openUpliftmentInformationModal');
	}

    public function bookUpliftment()
    {
        DB::beginTransaction();

        try {
            $driver = Driver::where('id', $this->selectedDriverId)->firstOrFail();

            // Calculate Upliftment End Time
            $start_time = Carbon::createFromFormat('H:i:s', $this->selectedTime);
            $end_time = $start_time->copy()->addMinutes(30);

            // Verify that no bookings overlap this time slot
            if (!$this->isTimeSlotAvailable($start_time, $end_time, $this->selectedDayId, $driver->id)) {
                DB::rollback();
                return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('fail_message', 'Time slot is not available.');
            }

            // Save the upliftment record
            $this->upliftment->fill([
                'user_id' => Auth::user()->id,
                'truck_id' => $this->selectedTruckId,
                'driver_id' => $driver->id,
                'upliftment_day_id' => $this->selectedDayId,
                'completed' => "No",    
                'date' => Carbon::parse($this->date)->format('Y-m-d'),
                'start_time' => $start_time->format('H:i:s'),
                'end_time' => $end_time->format('H:i:s'),
            ])->save();

            $price = $this->upliftment->weight * $this->upliftment->client_price;

            $purchaseOrder = new PurchaseOrder;

                $purchaseOrder->user_id = Auth::user()->id;
                $purchaseOrder->category = 'Eezee Batteries';
                $purchaseOrder->upliftment_id = $this->upliftment->id;
                $purchaseOrder->consultant_id = $this->upliftment->consultant_id;
                $purchaseOrder->consultant_name = $this->upliftment->consultant_name;
                $purchaseOrder->client_id = $this->upliftment->client_id;
                $purchaseOrder->client_name = $this->upliftment->client_name;
                $purchaseOrder->company_name = $this->upliftment->company_name;
                $purchaseOrder->supplier_account_code = '$client->supplier_account_code';
                $purchaseOrder->weight = $this->upliftment->weight;
                $purchaseOrder->price = $price;
                $purchaseOrder->province = $this->upliftment->province;
                $purchaseOrder->address = encrypt($this->upliftment->address);
                $purchaseOrder->stock_code = $this->upliftment->stock_code;
                $purchaseOrder->completed = 'No';

            $purchaseOrder->save();

            // Assuming $day is an instance of a Day model or similar
            $day = Day::findOrFail($this->selectedDayId);
            $this->updateDaySchedule($day, $start_time, $end_time);

            DB::commit();
            return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('success_message', 'Upliftment Booked');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('fail_message', 'Booking failed: ' . $e->getMessage());
        }
    }

    private function isTimeSlotAvailable($start_time, $end_time, $dayId, $driverId)
    {
        // Assuming Upliftment model stores each upliftment and is related to a Day and a Driver
        $overlapCount = Upliftment::where('upliftment_day_id', $dayId)
                                   ->where('driver_id', $driverId)
                                   ->where(function ($query) use ($start_time, $end_time) {
                                       $query->where(function ($query) use ($start_time, $end_time) {
                                           $query->where('start_time', '<', $end_time)
                                                ->where('end_time', '>', $start_time);
                                       });
                                   })
                                   ->count();
    
        return $overlapCount === 0; // True if no overlapping upliftments, false otherwise
    }

    private function updateDaySchedule($day, $start_time, $end_time)
    {
        // Mapping of hour numbers to words for AM times
        $hourToWord = [
            '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four',
            '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight',
            '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelvepm'
        ];

        // Mapping to handle PM times specifically as your fields use 'twelvepm' for noon
        $hourToWordPM = [
            '1' => 'onepm', '2' => 'twopm', '3' => 'threepm', '4' => 'fourpm', '5' => 'fivepm'
        ];

        // Extract the hour and minutes from start_time
        $hour = $start_time->format('g'); // Hour in 12-hour format without leading zeros
        $isPM = $start_time->format('A') == 'PM'; // Check if it's PM
        $minutes = $start_time->format('i');

        // Determine the appropriate suffix based on minutes
        $suffix = $minutes == '30' ? '_thirty' : '';

        // Use the mapping to get the word representation of the hour
        $timeKey = ($isPM && $hour != '12' ? $hourToWordPM[$hour] : $hourToWord[$hour]) . $suffix;

        // Prepare the property names based on the calculated time key
        $statusKey = $timeKey; // e.g., 'five' or 'five_thirty'
        $upliftmentIdKey = $timeKey . '_upliftment_id';
        $upliftmentInfoKey = $timeKey . '_upliftment_information';

        // Update the properties for the booked slot
        $day->$statusKey = 'BOOKED';
        $day->$upliftmentIdKey = $this->upliftment->id;
        $day->$upliftmentInfoKey = $this->upliftment->lat . ',' . $this->upliftment->lng . ', Upliftment';

        // Save the updated day record
        $day->save();
    }

    // public function bookUpliftment()
    // {
    //     DB::beginTransaction();

    //     $driver = Driver::where('id', $this->selectedDriverId)->first();

    //         // Calculate Upliftment End Time
    //         $start_time = Carbon::createFromFormat('H:i:s', $this->selectedTime);
    //         $end_time = $start_time->copy()->addMinutes(30);
        
    //         $this->upliftment->user_id = Auth::user()->id;
    //         $this->upliftment->truck_id = $this->selectedTruckId;
    //         $this->upliftment->driver_id = $driver->id;
    //         $this->upliftment->upliftment_day_id = $this->selectedDayId;
    //         $this->upliftment->completed = "No";    
    //         $this->upliftment->date = Carbon::parse($this->date)->format('Y-m-d');
    //         $this->upliftment->start_time = $this->selectedTime;
    //         $this->upliftment->end_time = $end_time;

    //     $this->upliftment->save();

    //     $day = Day::find($this->selectedDayId);

    //     $upliftment_information = $this->upliftment->lat. ',' . $this->upliftment->lng.  ', Upliftment';

    //     $time_slots = [
    //         $day->five_time => $day->five.',five,'.$day->five_upliftment_information,
    //         $day->five_thirty_time => $day->five_thirty.',five_thirty,'.$day->five_thirty_upliftment_information,
    //         $day->six_time => $day->six.',six,'.$day->six_upliftment_information,
    //         $day->six_thirty_time => $day->six_thirty.',six_thirty,'.$day->six_thirty_upliftment_information,
    //         $day->seven_time => $day->seven.',seven,'.$day->seven_upliftment_information,
    //         $day->seven_thirty_time => $day->seven_thirty.',seven_thirty,'.$day->seven_thirty_upliftment_information,
    //         $day->eight_time => $day->eight.',eight,'.$day->eight_upliftment_information,
    //         $day->eight_thirty_time => $day->eight_thirty.',eight_thirty,'.$day->eight_thirty_upliftment_information,
    //         $day->nine_time => $day->nine.',nine,'.$day->nine_upliftment_information,
    //         $day->nine_thirty_time => $day->nine_thirty.',nine_thirty,'.$day->nine_thirty_upliftment_information,
    //         $day->ten_time => $day->ten.',ten,'.$day->ten_upliftment_information,
    //         $day->ten_thirty_time => $day->ten_thirty.',ten_thirty,'.$day->ten_thirty_upliftment_information,
    //         $day->eleven_time => $day->eleven.',eleven,'.$day->eleven_upliftment_information,
    //         $day->eleven_thirty_time => $day->eleven_thirty.',eleven_thirty,'.$day->eleven_thirty_upliftment_information,
    //         $day->twelvepm_time => $day->twelvepm.',twelvepm,'.$day->twelvepm_upliftment_information,
    //         $day->twelvepm_thirty_time => $day->twelvepm_thirty.',twelvepm_thirty,'.$day->twelvepm_thirty_upliftment_information,
    //         $day->onepm_time => $day->onepm.',onepm,'.$day->onepm_upliftment_information,
    //         $day->onepm_thirty_time => $day->onepm_thirty.',onepm_thirty,'.$day->onepm_thirty_upliftment_information,
    //         $day->twopm_time => $day->twopm.',twopm,'.$day->twopm_upliftment_information,
    //         $day->twopm_thirty_time => $day->twopm_thirty.',twopm_thirty,'.$day->twopm_thirty_upliftment_information,
    //         $day->threepm_time => $day->threepm.',threepm,'.$day->threepm_upliftment_information,
    //         $day->threepm_thirty_time => $day->threepm_thirty.',threepm_thirty,'.$day->threepm_thirty_upliftment_information,
    //         $day->fourpm_time => $day->fourpm.',fourpm,'.$day->fourpm_upliftment_information,
    //         $day->fourpm_thirty_time => $day->fourpm_thirty.',fourpm_thirty,'.$day->fourpm_thirty_upliftment_information,
    //         $day->fivepm_time => $day->fivepm.',fivepm,'.$day->fivepm_upliftment_information,
    //         $day->fivepm_thirty_time => $day->fivepm_thirty.',fivepm_thirty,'.$day->fivepm_thirty_upliftment_information,
    //     ];
    //     $new_time_slots = [];
    //     $booked_or_not = [];

    //     foreach($time_slots as $key => $time_slot){
    //         if($key == $this->selectedTime){
    //             $new_time_slots[$key] = $time_slot;
    //             if(explode(',', $time_slot)[0] == 'Reserved'){
    //                 array_push($booked_or_not, explode(',', $time_slot)[0],explode(',', $time_slot)[3]);
    //             } else {
    //                 array_push($booked_or_not, explode(',', $time_slot)[0]);
    //             }
    //         } elseif($key > $this->selectedTime){
    //             if($key <= $end_time){
    //                 $new_time_slots[$key] = $time_slot;
    //                 if(explode(',', $time_slot)[0] == 'Reserved'){
    //                     array_push($booked_or_not, explode(',', $time_slot)[0],explode(',', $time_slot)[3]);
    //                 } else {
    //                     array_push($booked_or_not, explode(',', $time_slot)[0]);
    //                 }
    //             }
    //         }
    //     }
        
    //     if(in_array("Booked", $booked_or_not)){
    //         // Not enough Time
    //         DB::rollback();
    //         return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('fail_message', 'There is not enough time to fit in this upliftment');
    //     } elseif(in_array("Reserved", $booked_or_not)){
    //         // Book the Upliftment
    //         foreach($new_time_slots as $new_time_slot){
    //             $day_open_or_booked = explode(',', $new_time_slot)[1];
    //             $day_upliftment_id = explode(',', $new_time_slot)[1].'_upliftment_id';
    //             $day_upliftment_information = explode(',', $new_time_slot)[1].'_upliftment_information';

    //                 $day->$day_open_or_booked = "Booked";
    //                 $day->$day_upliftment_id = $this->upliftment->id;
    //                 $day->$day_upliftment_information = $upliftment_information;
                
    //             $day->save();

    //             // if(explode(',', $new_time_slot)[0] == 'Reserved'){
    //             //     if(explode(',', $new_time_slot)[3] != Auth::user()->id){
    //             //         $reservedUser = User::find(explode(',', $new_time_slot)[3]);
    //             //         $reservedUser->notify(new StaffReservationBooked($this->ticket));
    //             //     }
    //             // }
    //         }
    //     } else {
    //         // Book the Upliftment
    //         foreach($new_time_slots as $new_time_slot){
    //             $day_open_or_booked = explode(',', $new_time_slot)[1];
    //             $day_upliftment_id = explode(',', $new_time_slot)[1].'_upliftment_id';
    //             $day_upliftment_information = explode(',', $new_time_slot)[1].'_upliftment_information';

    //                 $day->$day_open_or_booked = "Booked";
    //                 $day->$day_upliftment_id = $this->upliftment->id;
    //                 $day->$day_upliftment_information = $upliftment_information;
                
    //             $day->save();
    //         }
    //     }

    //     $price = $this->upliftment->weight * $this->upliftment->client_price;

    //     $purchaseOrder = new PurchaseOrder;

    //         $purchaseOrder->user_id = Auth::user()->id;
    //         $purchaseOrder->category = 'Eezee Batteries';
    //         $purchaseOrder->upliftment_id = $this->upliftment->id;
    //         $purchaseOrder->consultant_id = $this->upliftment->consultant_id;
    //         $purchaseOrder->consultant_name = $this->upliftment->consultant_name;
    //         $purchaseOrder->client_id = $this->upliftment->client_id;
    //         $purchaseOrder->client_name = $this->upliftment->client_name;
    //         $purchaseOrder->company_name = $this->upliftment->company_name;
    //         $purchaseOrder->supplier_account_code = '$client->supplier_account_code';
    //         $purchaseOrder->weight = $this->upliftment->weight;
    //         $purchaseOrder->price = $price;
    //         $purchaseOrder->province = $this->upliftment->province;
    //         $purchaseOrder->address = encrypt($this->upliftment->address);
    //         $purchaseOrder->stock_code = $this->upliftment->stock_code;
    //         $purchaseOrder->completed = 'No';

    //     $purchaseOrder->save();

    //     DB::commit();

    //     return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('success_message', 'Upliftment Booked');
    // }

    public function render()
    {
        return view('livewire.eezee-holdings.eezee-batteries.client.show.upliftment.book-upliftment');
    }
}
