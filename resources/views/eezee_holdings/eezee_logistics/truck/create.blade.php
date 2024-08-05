<x-master>
    <x-container>
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">New Truck for Eezee Logistics</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="/eezee_logistics/truck/index"><span class="text-dark-50 font-weight-bold text-hover-primary">Trucks</span></a>
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
        <form role="form" method="POST" action="/eezee_logistics/truck/store" class="form-prevent-multiple-submits" enctype="multipart/form-data">
            @csrf()
            <x-card>
                <x-slot name="main">
                    Truck Information
                </x-slot>
                <x-slot name="sub">
                    Fill in the truck details below
                </x-slot>
                <x-slot name="toolbar">

                </x-slot>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Name<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required />
                    </div>
                    <div class="col-md-6">
                        <label>Registration<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="registration" id="registration" placeholder="Registration" value="{{ old('registration') }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Weight in Kg<span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="weight" id="weight" placeholder="4" value="{{ old('weight') }}" required />
                    </div>
                </div>
            </x-card>
            <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3" type="submit">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary font-weight-bold float-right form-prevent-multiple-submits mr-3">Cancel</a>
        </form>
    </x-container>
</x-master>
