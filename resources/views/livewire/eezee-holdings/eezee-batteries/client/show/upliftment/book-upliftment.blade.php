<div>
    <x-card>
        <x-slot name="main">
            Book Appointment
        </x-slot>
        <x-slot name="sub">
            Book an Upliftment below
        </x-slot>
        <x-slot name="toolbar">

        </x-slot>
        <div class="row pt-5">
            <div class="col-lg-6" wire:ignore>
                <label>Upliftment Date<span style="color: red"> *</span></label>
                <div class="input-group date">
                    <input type="text" class="form-control" readonly="readonly" placeholder="yyyy-mm-dd" id="kt_datepicker_1_modal" wire:model="date" required />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    @if ($this->date)
        <x-card>
            <x-slot name="main">
                Available Drivers for {{ Carbon\Carbon::parse($this->date)->format('D d M Y') }}
            </x-slot>
            <x-slot name="sub">
                Select a time slot below to book an appointment
            </x-slot>
            <x-slot name="toolbar">

            </x-slot>
            <div class="tableFixHead">
                <table style="padding-left:10px;" id="table" class="table table-striped table-bordered table-border-#F64E60" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="sticky-col first-col">Driver</th>
                            <th class="sticky-col second-col">Truck</th>
                            <th class="sticky-col third-col">Distance</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">05:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">05:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">06:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">06:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">07:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">07:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">08:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">08:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">09:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">09:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">10:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">10:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">11:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">11:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">12:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">12:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">13:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">13:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">14:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">14:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">15:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">15:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">16:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">16:30</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">17:00</th>
                            <th style="text-align: center; font-weight: bold" class="sticky-col fourth-col">17:30</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $day)
                            @foreach ($trucks as $truck)
                                @if ($truck->drivers->contains($day->driver))
                                    <tr>
                                        <th class="sticky-col first-col">{{ $day->driver->first_name }} {{ $day->driver->last_name }}</th>
                                        <th class="sticky-col second-col">{{ $truck->name }}</th>
                                        <th class="sticky-col third-col">{{ round($driverDistance[$day->driver_id]) }} KM</th>
                                        @if ($day->five == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->five_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven }}</a>
                                            </td>
                                        @elseif($day->five == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->five_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven }}</a>
                                            </td>
                                        @elseif($day->five == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->five }}</a>
                                            </td>
                                        @elseif($day->five == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->five_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->five_appointment_id }}')">{{ $day->five }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->five_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->five_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->five_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->five_appointment_id }}')">{{ $day->five }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->five_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->five_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->five_thirty }}</a>
                                            </td>
                                        @elseif($day->five_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->five_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->five_thirty }}</a>
                                            </td>
                                        @elseif($day->five_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->five_thirty }}</a>
                                            </td>
                                        @elseif($day->five_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->five_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->five_thirty_appointment_id }}')">{{ $day->five_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->five_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->five_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->five_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->five_thirty_appointment_id }}')">{{ $day->five_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->six == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->six_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->six }}</a>
                                            </td>
                                        @elseif($day->six == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->six_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->six }}</a>
                                            </td>
                                        @elseif($day->six == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->six }}</a>
                                            </td>
                                        @elseif($day->six == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->six_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->six_appointment_id }}')">{{ $day->six }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->six_appointment_information)[0])) / 2), 2) +  cos(explode(',', $day->six_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->six_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->six_appointment_id }}')">{{ $day->six }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->six_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->six_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->six_thirty }}</a>
                                            </td>
                                        @elseif($day->six_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->six_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->six_thirty }}</a>
                                            </td>
                                        @elseif($day->six_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->six_thirty }}</a>
                                            </td>
                                        @elseif($day->six_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->six_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->six_thirty_appointment_id }}')">{{ $day->six_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->six_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->six_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->six_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->six_thirty_appointment_id }}')">{{ $day->six_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->seven == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->seven_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven }}</a>
                                            </td>
                                        @elseif($day->seven == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->seven_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven }}</a>
                                            </td>
                                        @elseif($day->seven == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->seven }}</a>
                                            </td>
                                        @elseif($day->seven == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->seven_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->seven_appointment_id }}')">{{ $day->seven }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->seven_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->seven_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->seven_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->seven_appointment_id }}')">{{ $day->seven }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->seven_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->seven_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven_thirty }}</a>
                                            </td>
                                        @elseif($day->seven_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->seven_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->seven_thirty }}</a>
                                            </td>
                                        @elseif($day->seven_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->seven_thirty }}</a>
                                            </td>
                                        @elseif($day->seven_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->seven_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->seven_thirty_appointment_id }}')">{{ $day->seven_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->seven_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->seven_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->seven_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->seven_thirty_appointment_id }}')">{{ $day->seven_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->eight == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eight_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eight }}</a>
                                            </td>
                                        @elseif($day->eight == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eight_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eight }}</a>
                                            </td>
                                        @elseif($day->eight == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->eight }}</a>
                                            </td>
                                        @elseif($day->eight == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->eight_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eight_thirty_appointment_id }}')">{{ $day->eight_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->eight_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->eight_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->eight_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eight_appointment_id }}')">{{ $day->eight }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->eight_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eight_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eight_thirty }}</a>
                                            </td>
                                        @elseif($day->eight_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eight_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eight_thirty }}</a>
                                            </td>
                                        @elseif($day->eight_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->eight_thirty }}</a>
                                            </td>
                                        @elseif($day->eight_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->eight_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eight_thirty_appointment_id }}')">{{ $day->eight_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->eight_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->eight_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->eight_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eight_thirty_appointment_id }}')">{{ $day->eight_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->nine == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->nine_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->nine }}</a>
                                            </td>
                                        @elseif($day->nine == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->nine_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->nine }}</a>
                                            </td>
                                        @elseif($day->nine == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->nine }}</a>
                                            </td>
                                        @elseif($day->nine == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->nine_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->nine_appointment_id }}')">{{ $day->nine }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->nine_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->nine_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->nine_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->nine_appointment_id }}')">{{ $day->nine }}</a>
                                                @endif
                                            </td>
                                        @endif


                                        @if ($day->nine_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->nine_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->nine_thirty }}</a>
                                            </td>
                                        @elseif($day->nine_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->nine_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->nine_thirty }}</a>
                                            </td>
                                        @elseif($day->nine_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->nine_thirty }}</a>
                                            </td>
                                        @elseif($day->nine_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->nine_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->nine_thirty_appointment_id }}')">{{ $day->nine_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->nine_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->nine_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->nine_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->nine_thirty_appointment_id }}')">{{ $day->nine_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->ten == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->ten_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->ten }}</a>
                                            </td>
                                        @elseif($day->ten == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->ten_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->ten }}</a>
                                            </td>
                                        @elseif($day->ten == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->ten }}</a>
                                            </td>
                                        @elseif($day->ten == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->ten_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->ten_appointment_id }}')">{{ $day->ten }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->ten_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->ten_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->ten_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->ten_appointment_id }}')">{{ $day->ten }}</a>
                                                @endif
                                            </td>
                                        @endif


                                        @if ($day->ten_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->ten_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->ten_thirty }}</a>
                                            </td>
                                        @elseif($day->ten_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->ten_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->ten_thirty }}</a>
                                            </td>
                                        @elseif($day->ten_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->ten_thirty }}</a>
                                            </td>
                                        @elseif($day->ten_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->ten_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->ten_thirty_appointment_id }}')">{{ $day->ten_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->ten_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->ten_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->ten_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->ten_thirty_appointment_id }}')">{{ $day->ten_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->eleven == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eleven_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eleven }}</a>
                                            </td>
                                        @elseif($day->eleven == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eleven_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eleven }}</a>
                                            </td>
                                        @elseif($day->eleven == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->eleven }}</a>
                                            </td>
                                        @elseif($day->eleven == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->eleven_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eleven_appointment_id }}')">{{ $day->eleven }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->eleven_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->eleven_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->eleven_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eleven_appointment_id }}')">{{ $day->eleven }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->eleven_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eleven_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eleven_thirty }}</a>
                                            </td>
                                        @elseif($day->eleven_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->eleven_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->eleven_thirty }}</a>
                                            </td>
                                        @elseif($day->eleven_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->eleven_thirty }}</a>
                                            </td>
                                        @elseif($day->eleven_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->eleven_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eleven_thirty_appointment_id }}')">{{ $day->eleven_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->eleven_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->eleven_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->eleven_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->eleven_thirty_appointment_id }}')">{{ $day->eleven_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->twelvepm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twelvepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twelvepm }}</a>
                                            </td>
                                        @elseif($day->twelvepm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twelvepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twelvepm }}</a>
                                            </td>
                                        @elseif($day->twelvepm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->twelvepm }}</a>
                                            </td>
                                        @elseif($day->twelvepm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->twelvepm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twelvepm_appointment_id }}')">{{ $day->twelvepm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->twelvepm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->twelvepm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->twelvepm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twelvepm_appointment_id }}')">{{ $day->twelvepm }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->twelvepm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twelvepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twelvepm_thirty }}</a>
                                            </td>
                                        @elseif($day->twelvepm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twelvepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twelvepm_thirty }}</a>
                                            </td>
                                        @elseif($day->twelvepm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->twelvepm_thirty }}</a>
                                            </td>
                                        @elseif($day->twelvepm_thirty == 'Booked')
                                            <td style="background-color:#F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->twelvepm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twelvepm_thirty_appointment_id }}')">{{ $day->twelvepm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->twelvepm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->twelvepm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->twelvepm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twelvepm_thirty_appointment_id }}')">{{ $day->twelvepm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->onepm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->onepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->onepm }}</a>
                                            </td>
                                        @elseif($day->onepm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->onepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->onepm }}</a>
                                            </td>
                                        @elseif($day->onepm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->onepm }}</a>
                                            </td>
                                        @elseif($day->onepm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->onepm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->onepm_appointment_id }}')">{{ $day->onepm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->onepm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->onepm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->onepm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->onepm_appointment_id }}')">{{ $day->onepm }} </a>
                                                @endif
                                            </td>
                                        @endif


                                        @if ($day->onepm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->onepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->onepm_thirty }}</a>
                                            </td>
                                        @elseif($day->onepm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->onepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->onepm_thirty }}</a>
                                            </td>
                                        @elseif($day->onepm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->onepm_thirty }}</a>
                                            </td>
                                        @elseif($day->onepm_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->onepm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->onepm_thirty_appointment_id }}')">{{ $day->onepm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->onepm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->onepm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->onepm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->onepm_thirty_appointment_id }}')">{{ $day->onepm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif


                                        @if ($day->twopm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twopm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twopm }}</a>
                                            </td>
                                        @elseif($day->twopm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twopm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twopm }}</a>
                                            </td>
                                        @elseif($day->twopm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->twopm }}</a>
                                            </td>
                                        @elseif($day->twopm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->twopm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twopm_appointment_id }}')">{{ $day->twopm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->twopm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->twopm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->twopm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twopm_appointment_id }}')">{{ $day->twopm }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->twopm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twopm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twopm_thirty }}</a>
                                            </td>
                                        @elseif($day->twopm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->twopm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->twopm_thirty }}</a>
                                            </td>
                                        @elseif($day->twopm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->twopm_thirty }}</a>
                                            </td>
                                        @elseif($day->twopm_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->twopm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twopm_thirty_appointment_id }}')">{{ $day->twopm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->twopm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->twopm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->twopm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->twopm_thirty_appointment_id }}')">{{ $day->twopm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->threepm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->threepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->threepm }}</a>
                                            </td>
                                        @elseif($day->threepm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->threepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->threepm }}</a>
                                            </td>
                                        @elseif($day->threepm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->threepm }}</a>
                                            </td>
                                        @elseif($day->threepm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->threepm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->threepm_appointment_id }}')">{{ $day->threepm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->threepm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->threepm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->threepm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->threepm_appointment_id }}')">{{ $day->threepm }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->threepm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->threepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->threepm_thirty }}</a>
                                            </td>
                                        @elseif($day->threepm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->threepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->threepm_thirty }}</a>
                                            </td>
                                        @elseif($day->threepm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->threepm_thirty }}</a>
                                            </td>
                                        @elseif($day->threepm_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->threepm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->threepm_thirty_appointment_id }}')">{{ $day->threepm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->threepm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->threepm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->threepm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->threepm_thirty_appointment_id }}')">{{ $day->threepm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->fourpm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fourpm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fourpm }}</a>
                                            </td>
                                        @elseif($day->fourpm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fourpm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fourpm }}</a>
                                            </td>
                                        @elseif($day->fourpm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->fourpm }}</a>
                                            </td>
                                        @elseif($day->fourpm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->fourpm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fourpm_appointment_id }}')">{{ $day->fourpm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->fourpm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->fourpm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->fourpm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fourpm_appointment_id }}')">{{ $day->fourpm }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->fourpm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fourpm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fourpm_thirty }}</a>
                                            </td>
                                        @elseif($day->fourpm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fourpm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fourpm_thirty }}</a>
                                            </td>
                                        @elseif($day->fourpm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->fourpm_thirty }}</a>
                                            </td>
                                        @elseif($day->fourpm_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->fourpm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fourpm_thirty_appointment_id }}')">{{ $day->fourpm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->fourpm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->fourpm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->fourpm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fourpm_thirty_appointment_id }}')">{{ $day->fourpm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->fivepm == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fivepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fivepm }}</a>
                                            </td>
                                        @elseif($day->fivepm == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fivepm_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fivepm }}</a>
                                            </td>
                                        @elseif($day->fivepm == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;">{{ $day->fivepm }}</a>
                                            </td>
                                        @elseif($day->fivepm == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->fivepm_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fivepm_appointment_id }}')">{{ $day->fivepm }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->fivepm_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->fivepm_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->fivepm_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fivepm_appointment_id }}')">{{ $day->fivepm }}</a>
                                                @endif
                                            </td>
                                        @endif

                                        @if ($day->fivepm_thirty == 'OPEN')
                                            <td style="background-color: #1BC5BD; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fivepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fivepm_thirty }}</a>
                                            </td>
                                        @elseif($day->fivepm_thirty == 'Reserved')
                                            <td style="background-color: #a19e98; color: white; text-align: center; font-weight: bold">
                                                <a style="color:inherit;" wire:click="selectTime('{{ $day->fivepm_thirty_time }}', '{{ $day->driver->first_name }} {{ $day->driver->last_name }}', '{{ $day->driver->id }}', '{{ $truck->id }}', '{{ $day->id }}', '{{ round($driverDistance[$day->driver_id]) }}')">{{ $day->fivepm_thirty }}</a>
                                            </td>
                                        @elseif($day->fivepm_thirty == 'Busy')
                                            <td style="background-color: #FFA800; color: white; text-align: center; font-weight: bold">
                                                <a href="#" style="color:inherit;">{{ $day->fivepm_thirty }}</a>
                                            </td>
                                        @elseif($day->fivepm_thirty == 'Booked')
                                            <td style="background-color: #F64E60; color: white; text-align: center; font-weight: bold">
                                                @if(in_array('-', str_split(explode(',', $day->fivepm_thirty_appointment_information)[0])))
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fivepm_thirty_appointment_id }}')">{{ $day->fivepm_thirty }} {{round(((2 * asin(sqrt(pow(sin((deg2rad($upliftment->lat) - deg2rad(explode(',', $day->fivepm_thirty_appointment_information)[0])) / 2), 2) + cos(explode(',', $day->fivepm_thirty_appointment_information)[0]) * cos($upliftment->lat) * pow(sin((deg2rad($upliftment->lng) - deg2rad(explode(',', $day->fivepm_thirty_appointment_information)[1])) / 2), 2)))) * 10000), 0)}} km</a>
                                                @else
                                                    <a style="color:inherit;" wire:click="viewBookedUpliftment('{{ $day->fivepm_thirty_appointment_id }}')">{{ $day->fivepm_thirty }}</a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal for booking Driver -->
            <div class="modal fade upliftmentModal" id="upliftmentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Booking with {{ $selectedDriver }} and {{ $selectedTruckId }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Upliftment Starting Time</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" wire:model.defer="start_time" id="start_time" value="{{ $selectedTime }}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" wire:ignore>
                            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success font-weight-bold" wire:click="bookUpliftment()">Book Upliftment</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Upliftment Information -->
            <div class="modal fade upliftmentInformationModal" id="upliftmentInformationModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upliftment Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label><b>Consultant</b></label>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $selectedUpliftmentConsultant }}</p>
                                </div>
                                <div class="col-md-3">
                                    <label><b>Address</b></label>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $selectedUpliftmentAddress }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/ticket/{{ $selectedUpliftmentId }}" target="_blank" class="btn btn-primary">View Upliftment</a>
                            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End::Modals -->
        </x-card>
        
    @endif

    @push('scripts')
        <script type="text/javascript">
            window.addEventListener('openUpliftmentModal', event => {
                $("#upliftmentModal").modal('show');
            })
        </script>
        <script type="text/javascript">
            window.addEventListener('openUpliftmentInformationModal', event => {
                $("#upliftmentInformationModal").modal('show');
            })
        </script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://datatables.net/release-datatables/media/js/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                });
            });
        </script>

        <script type="text/javascript">
            $('#kt_datepicker_1_modal').on('change', function(e) {
                @this.set('date', e.target.value);
                @this.actualMount();
            });

            // Class definition
            var KTBootstrapDatepicker = function() {

                var arrows;
                if (KTUtil.isRTL()) {
                    arrows = {
                        leftArrow: '<i class="la la-angle-right"></i>',
                        rightArrow: '<i class="la la-angle-left"></i>'
                    }
                } else {
                    arrows = {
                        leftArrow: '<i class="la la-angle-left"></i>',
                        rightArrow: '<i class="la la-angle-right"></i>'
                    }
                }

                // Private functions
                var demos = function() {
                    // input group layout for modal demo
                    $('#kt_datepicker_1_modal').datepicker({
                        rtl: KTUtil.isRTL(),
                        todayHighlight: true,
                        orientation: "bottom left",
                        templates: arrows,
                        autoclose: true,
                        format: 'yyyy-mm-dd'
                    });
                }

                return {
                    // public functions
                    init: function() {
                        demos();
                    }
                };
            }();

            jQuery(document).ready(function() {
                KTBootstrapDatepicker.init();
            });
        </script>
    @endpush
</div>
