<x-master>
    <x-container>
        @section('styles')
            <!-- Google Maps Styles -->
            <style>
                #map-canvas {
                    width: 100%;
                    height: 600px;
                }
            </style>
        @endsection
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">New Client for Eezee Batteries</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="/eezee_batteries/client/index"><span class="text-dark-50 font-weight-bold text-hover-primary">Clients</span></a>
            </x-slot>
        </x-heading>
		@if (count($errors) > 0)
	        @foreach ($errors->all() as $error)
				<div class="alert alert-custom alert-outline-2x alert-outline-primary fade show mb-5" role="alert">
		            <div class="alert-icon"><i class="flaticon-warning"></i></div>
		            <div class="alert-text">{{ $error }}</div>
		            <div class="alert-close">
		                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
		                </button>
		            </div>
		        </div>
		    @endforeach
	    @endif
        <form role="form" method="POST" action="/eezee_batteries/client/store" class="form-prevent-multiple-submits" enctype="multipart/form-data">
            @csrf()
            <x-card>
                <x-slot name="main">
                    Client Information
                </x-slot>
                <x-slot name="sub">
                    Fill in the client details below
                </x-slot>
                <x-slot name="toolbar">

                </x-slot>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Company<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="{{ old('company_name') }}" required />
                    </div>
                    <div class="col-md-6">
                        <label>Client First & Last Name<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Client First & Last Name" value="{{ old('client_name') }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Telephone Number<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="telephone_1" id="telephone_1" placeholder="Primary Telephone Number" value="{{ old('telephone_1') }}" autocomplete="off" required />
                    </div>
                    <div class="col-md-6">
                        <label>Secondary Telephone Number</label>
                        <input type="text" class="form-control" name="telephone_2" id="telephone_2" placeholder="Alternative Telephone Number" value="{{ old('telephone_2') }}" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" />
                    </div>
                    <div class="col-md-6">
                        <label>Price<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="18.50" value="{{ old('price') }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Client Comments</label>
                        <textarea class="form-control" name="client_comments" id="client_comments" placeholder="Client Comments"></textarea>
                    </div>
                </div>
            </x-card>

            <x-card>
                <x-slot name="main">
                    Client Address
                </x-slot>
                <x-slot name="sub">
                    Search the Client's Address
                </x-slot>
                <x-slot name="toolbar">

                </x-slot>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Physical Address<span style="color: red"> *</span></label>
                        <input type="search" id="searchmap" class="form-control" placeholder="Search Address..." name="address">
                        <input hidden type="text" name="lat" id="lat" required>
                        <input hidden type="text" name="lng" id="lng" required>
                        <input hidden type="text" name="province" id="province" required>
                        <br>
                        <div class="form-group">
                            <div id="map-canvas"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Address Comments</label>
                        <textarea class="form-control" name="address_comments" id="address_comments" rows="3"></textarea>
                    </div>
                </div>
            </x-card>
            <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3" type="submit">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary font-weight-bold float-right form-prevent-multiple-submits mr-3">Cancel</a>
        </form>
        @section('scripts')
            <!--begin::Page Scripts(used by this page)-->
            <!-- Google Maps API JavaScript -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ad9W0qb4-1clgY61PwOanhEkEWJR3CY&libraries=places" type="text/javascript"></script>
            <script type="text/javascript">
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: {
                        lat: -26.19,
                        lng: 28.31
                    },
                    zoom: 9
                });

                var marker = new google.maps.Marker({
                    Position: {
                        lat: -26.19,
                        lng: 28.31
                    },
                    map: map,
                    draggable: true
                });
                var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
                google.maps.event.addListener(searchBox, 'places_changed', function() {
                    var places = searchBox.getPlaces();
                    var bounds = new google.maps.LatLngBounds();
                    var place = places[0];
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                    map.fitBounds(bounds);
                    map.setZoom(18);

                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();
                    $('#lat').val(lat);
                    $('#lng').val(lng);

                    var province = place.address_components.find(component => 
                        component.types.includes('administrative_area_level_1')).long_name;

                    $('#province').val(province);
                });
                google.maps.event.addListener(marker, 'position_changed', function() {
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                });
            </script>

            <script type="text/javascript">
                // Class definition
                var KTInputmask = function() {

                    // Private functions
                    var demos = function() {
                        $("#telephone_1").inputmask("9999999999", {
                            "placeholder": "",
                            autoUnmask: true
                        });

                        $("#telephone_2").inputmask("9999999999", {
                            "placeholder": "",
                            autoUnmask: true
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
                    KTInputmask.init();
                });
            </script>
        @endsection
    </x-container>
</x-master>
