<div>
    @section('styles')
        <!-- Google Maps Styles -->
        <style>
            #map-canvas {
                width: 100%;
                height: 600px;
            }
        </style>
    @endsection
    <x-card>
        <x-slot name="main">
            Address
        </x-slot>
        <x-slot name="sub">
            Search the Client's Address
        </x-slot>
        <x-slot name="toolbar">

        </x-slot>
        <form wire:submit.prevent="calculateCost">
            <div class="form-group row">
                <div class="col-md-3">
                    <label>Weight in Kg<span style="color: red"> *</span></label>
                    <input type="number" class="form-control" wire:model="weight" id="weight" placeholder="950" required />
                </div>
                <div class="col-md-9">
                    <label>Physical Address<span style="color: red"> *</span></label>
                    <input type="search" id="searchmap" class="form-control" placeholder="Search Address..." wire:model="address">
                    <input hidden type="text" wire:model="lat" id="latitude" required>
                    <input hidden type="text" wire:model="lng" id="longitude" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-group" wire:ignore>
                        <div id="map-canvas"></div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary font-weight-bold float-right form-prevent-multiple-submits mr-3 mt-5" type="submit">Calculate</button>
        </form>
        @if ($totalPotentialCost)
            <h1>Potential Profits</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th>Charge Amount</th>
                    <th>Potential Profit (R)</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $baselineRevenue = 18.25 * $weight;
                        $roundedCost = floor($totalPotentialCost / 0.10) * 0.10;
                    @endphp
                    <tr>
                        <td>{{ number_format($totalPotentialCost, 2) }}</td>
                        <td>{{ number_format($baselineRevenue - ($totalPotentialCost * $weight), 2) }}</td>
                    </tr>
                    @for ($i = 1; $i < 10; $i++)
                        @php
                            $currentCharge = $roundedCost - ($i * 0.10);
                            $currentRevenue = $currentCharge * $weight;
                        @endphp
                        <tr>
                            <td>{{ number_format($currentCharge, 2) }}</td>
                            <td>{{ number_format($baselineRevenue - $currentRevenue, 2) }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    </x-card>

    @section('scripts')
        <!-- Google Maps API JavaScript -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ad9W0qb4-1clgY61PwOanhEkEWJR3CY&libraries=places" type="text/javascript"></script>
        <script type="text/javascript">
            // Function to trigger Livewire input updates
            function updateLivewireInputs() {
                const latitudeInput = document.getElementById('latitude');
                const longitudeInput = document.getElementById('longitude');
        
                latitudeInput.dispatchEvent(new Event('input'));
                longitudeInput.dispatchEvent(new Event('input'));
            }
        
            // Initialize the Google Map
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: { lat: -26.1883, lng: 28.3208 },
                zoom: 15
            });
        
            // Initialize the marker
            var marker = new google.maps.Marker({
                position: { lat: -26.1883, lng: 28.3208 },
                map: map,
                draggable: true
            });
        
            // Initialize the search box and bind it to the UI element
            var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        
            // Listen for the event triggered when the user selects a prediction from the search box
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                var bounds = new google.maps.LatLngBounds();
                var place = places[0];
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
                map.fitBounds(bounds);
                map.setZoom(15);
        
                // Set the latitude and longitude in hidden inputs
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                updateLivewireInputs();  // Trigger Livewire to update
            });
        
            // Listen for marker position changes, which could be due to dragging
            google.maps.event.addListener(marker, 'position_changed', function() {
                document.getElementById('latitude').value = marker.getPosition().lat();
                document.getElementById('longitude').value = marker.getPosition().lng();
                updateLivewireInputs();  // Trigger Livewire to update
            });
        </script>
    @endsection
</div>
