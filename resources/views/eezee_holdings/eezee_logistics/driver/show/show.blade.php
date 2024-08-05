<x-master>
    <x-container>
        <x-messages></x-messages>
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Driver {{ $driver->id }} - {{ $driver->first_name }} {{ $driver->last_name }}</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="{{ url()->previous() }}"><span class="text-dark-50 font-weight-bold text-hover-primary" id="kt_subheader_total">Drivers</span></a>
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
        <!-- Driver Details -->
        <x-card>
            <x-slot name="main">
                Driver Details
            </x-slot>
            <x-slot name="sub">
                View the Driver's details below
            </x-slot>
            <x-slot name="toolbar">
                
            </x-slot>
            <livewire:eezee-holdings.eezee-logistics.driver.show.details :driver="$driver" />
        </x-card>

        <!-- Employment Terms -->
        <x-closed-card>
            <x-slot name="main">
                Employment Terms
            </x-slot>
            <x-slot name="sub">

            </x-slot>
            <x-slot name="toolbar">
                <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle">
                    <i class="ki ki-arrow-down icon-nm"></i>
                </a>
            </x-slot>
            <livewire:eezee-holdings.eezee-logistics.driver.show.employment-terms :driver="$driver" />
        </x-closed-card>

        <!-- Add Truck -->
        <x-closed-card>
            <x-slot name="main">
                Trucks
            </x-slot>
            <x-slot name="sub">

            </x-slot>
            <x-slot name="toolbar">
                <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle">
                    <i class="ki ki-arrow-down icon-nm"></i>
                </a>
            </x-slot>
            <livewire:eezee-holdings.eezee-logistics.driver.show.truck :driver="$driver" :trucks="$trucks" />
        </x-closed-card>
    </x-container>
</x-master>
