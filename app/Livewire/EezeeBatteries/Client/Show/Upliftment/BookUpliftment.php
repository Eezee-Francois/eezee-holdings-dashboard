<?php

namespace App\Livewire\EezeeBatteries\Client\Show\Upliftment;

use DB;
use PDF;
use Auth;
use File;
use Mail;
use finfo;
use Redirect;

use Carbon\Carbon;

use App\Models\EezeeBatteries\Upliftment;

use App\Models\EezeeLogistics\Day;
use App\Models\EezeeLogistics\Term;
use App\Models\EezeeLogistics\Truck;
use App\Models\EezeeLogistics\Driver;

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
    public $appointmentType;

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
        $this->trucks = Truck::where('size', '>=', '2')->get();

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

        $driver = Driver::where('id', $this->selectedDriverId)->first();

            //     // Calculate Appointment End Time
            //     $one_ton_time = $this->ticket->bloodtests->collect()->sum('time');
            //     $two_tons_time = $this->ticket->rapids->collect()->sum('time');
            //     $three_tons_time = $this->ticket->medicals->collect()->sum('time');
            //     $four_tons_time = $this->ticket->questionnaires->collect()->sum('time');

            //     $requirements_time = $bloodtest_time + $rapids_time + $medicals_time + $questionnaires_time + $reports_time;
                
            // $total_time = $this->travelTime + $requirements_time + Carbon::parse($this->selectedTime)->diffInMinutes('00:00:00');
            $total_time = Carbon::parse(60)->diffInMinutes('00:00:00');
            $end_time = (Carbon::parse($total_time*60)->format('H:i:s'));

        // if($this->distance < 60){
        //     $appointmentType = "Normal Appointment";
        // } elseif($this->distance < 99){
        //     $appointmentType = "Out of Area 1";
        // } else {
        //    $appointmentType = "Out of Area 2";
        // }
        
            $this->upliftment->user_id = Auth::user()->id;
            $this->upliftment->truck_id = $this->selectedTruckId;
            $this->upliftment->driver_id = $driver->id;
            $this->upliftment->appointment_day_id = $this->selectedDayId;
            // $this->upliftment->appointment_type = '$appointmentType';
            $this->upliftment->completed = "No";    
            $this->upliftment->date = Carbon::parse($this->date)->format('Y-m-d');
            $this->upliftment->start_time = $this->selectedTime;
            $this->upliftment->end_time = $end_time;

        $this->upliftment->save();

        $day = Day::find($this->selectedDayId);

        $appointment_information = $this->upliftment->lat. ',' . $this->upliftment->lng.  ', Appointment';

        $time_slots = [
            $day->five_time => $day->five.',five,'.$day->five_appointment_information,
            $day->five_thirty_time => $day->five_thirty.',five_thirty,'.$day->five_thirty_appointment_information,
            $day->six_time => $day->six.',six,'.$day->six_appointment_information,
            $day->six_thirty_time => $day->six_thirty.',six_thirty,'.$day->six_thirty_appointment_information,
            $day->seven_time => $day->seven.',seven,'.$day->seven_appointment_information,
            $day->seven_thirty_time => $day->seven_thirty.',seven_thirty,'.$day->seven_thirty_appointment_information,
            $day->eight_time => $day->eight.',eight,'.$day->eight_appointment_information,
            $day->eight_thirty_time => $day->eight_thirty.',eight_thirty,'.$day->eight_thirty_appointment_information,
            $day->nine_time => $day->nine.',nine,'.$day->nine_appointment_information,
            $day->nine_thirty_time => $day->nine_thirty.',nine_thirty,'.$day->nine_thirty_appointment_information,
            $day->ten_time => $day->ten.',ten,'.$day->ten_appointment_information,
            $day->ten_thirty_time => $day->ten_thirty.',ten_thirty,'.$day->ten_thirty_appointment_information,
            $day->eleven_time => $day->eleven.',eleven,'.$day->eleven_appointment_information,
            $day->eleven_thirty_time => $day->eleven_thirty.',eleven_thirty,'.$day->eleven_thirty_appointment_information,
            $day->twelvepm_time => $day->twelvepm.',twelvepm,'.$day->twelvepm_appointment_information,
            $day->twelvepm_thirty_time => $day->twelvepm_thirty.',twelvepm_thirty,'.$day->twelvepm_thirty_appointment_information,
            $day->onepm_time => $day->onepm.',onepm,'.$day->onepm_appointment_information,
            $day->onepm_thirty_time => $day->onepm_thirty.',onepm_thirty,'.$day->onepm_thirty_appointment_information,
            $day->twopm_time => $day->twopm.',twopm,'.$day->twopm_appointment_information,
            $day->twopm_thirty_time => $day->twopm_thirty.',twopm_thirty,'.$day->twopm_thirty_appointment_information,
            $day->threepm_time => $day->threepm.',threepm,'.$day->threepm_appointment_information,
            $day->threepm_thirty_time => $day->threepm_thirty.',threepm_thirty,'.$day->threepm_thirty_appointment_information,
            $day->fourpm_time => $day->fourpm.',fourpm,'.$day->fourpm_appointment_information,
            $day->fourpm_thirty_time => $day->fourpm_thirty.',fourpm_thirty,'.$day->fourpm_thirty_appointment_information,
            $day->fivepm_time => $day->fivepm.',fivepm,'.$day->fivepm_appointment_information,
            $day->fivepm_thirty_time => $day->fivepm_thirty.',fivepm_thirty,'.$day->fivepm_thirty_appointment_information,
        ];
        $new_time_slots = [];
        $booked_or_not = [];

        foreach($time_slots as $key => $time_slot){
            if($key == $this->selectedTime){
                $new_time_slots[$key] = $time_slot;
                if(explode(',', $time_slot)[0] == 'Reserved'){
                    array_push($booked_or_not, explode(',', $time_slot)[0],explode(',', $time_slot)[3]);
                } else {
                    array_push($booked_or_not, explode(',', $time_slot)[0]);
                }
            } elseif($key > $this->selectedTime){
                if($key <= $end_time){
                    $new_time_slots[$key] = $time_slot;
                    if(explode(',', $time_slot)[0] == 'Reserved'){
                        array_push($booked_or_not, explode(',', $time_slot)[0],explode(',', $time_slot)[3]);
                    } else {
                        array_push($booked_or_not, explode(',', $time_slot)[0]);
                    }
                }
            }
        }
        
        if(in_array("Booked", $booked_or_not)){
            // Not enough Time
            DB::rollback();
            return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('fail_message', 'There is not enough time to fit in this appointment');
        } elseif(in_array("Reserved", $booked_or_not)){
            // Book the Appointment
            foreach($new_time_slots as $new_time_slot){
                $day_open_or_booked = explode(',', $new_time_slot)[1];
                $day_appointment_id = explode(',', $new_time_slot)[1].'_appointment_id';
                $day_appointment_information = explode(',', $new_time_slot)[1].'_appointment_information';

                    $day->$day_open_or_booked = "Booked";
                    $day->$day_appointment_id = $this->upliftment->id;
                    $day->$day_appointment_information = $appointment_information;
                
                $day->save();

                // if(explode(',', $new_time_slot)[0] == 'Reserved'){
                //     if(explode(',', $new_time_slot)[3] != Auth::user()->id){
                //         $reservedUser = User::find(explode(',', $new_time_slot)[3]);
                //         $reservedUser->notify(new StaffReservationBooked($this->ticket));
                //     }
                // }
            }
        } else {
            // Book the Appointment
            foreach($new_time_slots as $new_time_slot){
                $day_open_or_booked = explode(',', $new_time_slot)[1];
                $day_appointment_id = explode(',', $new_time_slot)[1].'_appointment_id';
                $day_appointment_information = explode(',', $new_time_slot)[1].'_appointment_information';

                    $day->$day_open_or_booked = "Booked";
                    $day->$day_appointment_id = $this->upliftment->id;
                    $day->$day_appointment_information = $appointment_information;
                
                $day->save();
            }
        }
        DB::commit();

        return redirect('/eezee_batteries/client/'.$this->upliftment->client_id)->with('success_message', 'Upliftment Booked');
    }

    public function render()
    {
        return view('livewire.eezee-batteries.client.show.upliftment.book-upliftment');
    }
}
