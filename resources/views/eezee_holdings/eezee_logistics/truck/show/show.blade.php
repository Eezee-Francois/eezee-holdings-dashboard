<x-master>
    <x-container>
        <x-messages></x-messages>
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Truck {{ $truck->id }} - {{ $truck->name }}</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="{{ url()->previous() }}"><span class="text-dark-50 font-weight-bold text-hover-primary" id="kt_subheader_total">Trucks</span></a>
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
                Truck Details
            </x-slot>
            <x-slot name="sub">
                View the Truck's details below
            </x-slot>
            <x-slot name="toolbar">
                
            </x-slot>
            <livewire:eezee-holdings.eezee-logistics.truck.show.details :truck="$truck" />
        </x-card>
    </x-container>
</x-master>
