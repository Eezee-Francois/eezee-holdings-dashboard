<x-master>
    <x-container>
        @section('styles')
            <!-- Google Maps Styles -->
            <style>
                #map-canvas{
                    width: 100%;
                    height: 600px;
                }
            </style>
        @endsection

        <x-messages></x-messages>

        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Client {{ $client->id }} - {{ $client->company_name }}</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="{{ url()->previous() }}"><span class="text-dark-50 font-weight-bold text-hover-primary" id="kt_subheader_total">Clients</span></a>
            </x-slot>
        </x-heading>

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text font-weight-bold">{{ $error }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Client Details -->
        <x-card>
            <x-slot name="main">
                Client Details
            </x-slot>
            <x-slot name="sub">
                View the Client's details below
            </x-slot>
            <x-slot name="toolbar">
                
            </x-slot>
            <livewire:eezee-batteries.client.show.details :client="$client" />
        </x-card>

        <!-- Client Address -->
        <form method="POST" action="{{ route('eezee_batteries.client.address.update',$client->id) }}" class="form-prevent-multiple-submits">
            @csrf
            {{ method_field('PUT')}}
            <x-closed-card>
                <x-slot name="main">
                    Client Address
                </x-slot>
                <x-slot name="sub">
                    Search the Client's Address
                </x-slot>
                <x-slot name="toolbar">
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle">
                        <i class="ki ki-arrow-down icon-nm"></i>
                    </a>
                </x-slot>
                <div class="row">
                    <div class="col-md-12">
                        <label>Physical Address</label>
                        <input type="search" id="searchmap" class="form-control" value="{{ $client->address }}">
                        <input hidden type="text" name="address" value="{{ $client->address }}" id="address" required>
                        <input hidden type="text" name="lat" value="{{ $client->lat }}" id="lat" required>
                        <input hidden type="text" name="lng" value="{{ $client->lng }}" id="lng" required>
                        <input hidden type="text" name="province" value="{{ $client->province }}" id="province" required>
                        <br>
                        <div class="form-group">
                            <div id="map-canvas"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pt-5">
                        <label>Address Comments</label>
                        <textarea class="form-control" name="address_comments" id="address_comments" rows="3">{{ $client->address_comments }}</textarea>
                    </div>
                </div>
                <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3 mt-5" type="submit">Save</button>
            </x-closed-card>
        </form>

        <!-- Upliftments -->
        <livewire:eezee-batteries.client.show.upliftment.index :client="$client" />
        
        @role('Admin')
            <!-- Delete Client -->
            <x-closed-card>
                <x-slot name="main">
                    Delete Client
                </x-slot>
                <x-slot name="sub">
                    Delete the Client below
                </x-slot>
                <x-slot name="toolbar">
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle">
                        <i class="ki ki-arrow-down icon-nm"></i>
                    </a>
                </x-slot>
                <button class="btn btn-danger font-weight-bold float-right form-prevent-multiple-submits mr-3" data-toggle="modal" data-target="#deleteClient">Delete Client</button>
                <!-- Modal-->
                <div class="modal fade" id="deleteClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="delete-{{ $client->id }}" action="{{ route('client.destroy', $client->id) }}" method="POST" class="form-prevent-multiple-submits">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Client</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">Are you sure you would like to delete this Client?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Delete Client</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </x-closed-card>
        @endrole
        @push('scripts')
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX5DCWYi1MkWGs4OAcpYes1tIah3suRZ0&libraries=places" type="text/javascript"></script> 
            <script type="text/javascript">
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: {
                        lat: {{ $client->lat }},
                        lng: {{ $client->lng }}
                    },
                    zoom: 18
                });
            
                var marker = new google.maps.Marker({
                    position: {
                        lat: {{ $client->lat }},
                        lng: {{ $client->lng }}
                    },
                    map: map,
                    draggable: true
                });
            
                var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
            
                google.maps.event.addListener(searchBox, 'places_changed', function() {
                    var places = searchBox.getPlaces();
                    var bounds = new google.maps.LatLngBounds();
                    var place = places[0];
            
                    if (!place.geometry) {
                        return;
                    }
            
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location); // set marker position new
            
                    map.fitBounds(bounds);
                    map.setZoom(18);
            
                    // Update the address and province
                    var address = place.formatted_address;
                    var addressComponents = place.address_components;
                    var province = '';
            
                    // Extract province
                    for (var i = 0; i < addressComponents.length; i++) {
                        if (addressComponents[i].types.includes('administrative_area_level_1')) {
                            province = addressComponents[i].long_name;
                            break;
                        }
                    }
            
                    $('#address').val(address);
                    $('#province').val(province);
                    $('#lat').val(place.geometry.location.lat());
                    $('#lng').val(place.geometry.location.lng());
                });
            
                google.maps.event.addListener(marker, 'position_changed', function() {
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();
            
                    // Reverse geocode to get the address and province from lat/lng
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'location': {lat: lat, lng: lng}}, function(results, status) {
                        if (status === 'OK' && results[0]) {
                            var address = results[0].formatted_address;
                            var addressComponents = results[0].address_components;
                            var province = '';
            
                            // Extract province
                            for (var i = 0; i < addressComponents.length; i++) {
                                if (addressComponents[i].types.includes('administrative_area_level_1')) {
                                    province = addressComponents[i].long_name;
                                    break;
                                }
                            }

                            $('#address').val(address);
                            $('#province').val(province);
                        }
                    });
                    
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                });
            </script>              
        @endpush
    </x-container>
</x-master>
