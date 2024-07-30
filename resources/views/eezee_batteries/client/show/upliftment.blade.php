<x-master>
    <x-container>
        @section('styles')
            <!-- Booking Table Styles -->
            <style>
                .tableFixHead {
                    overflow: auto;
                    height: 150px;
                }
                .tableFixHead thead th {
                    position: sticky;
                    top: 0;
                    z-index: 1;
                }
                .sticky-col {
                    position: -webkit-sticky;
                    position: sticky;
                    background-color: white;
                }
                .first-col {
                    width: 100px;
                    min-width: 100px;
                    max-width: 100px;
                    left: 0px;
                }
                .second-col {
                    width: 100px;
                    min-width: 100px;
                    max-width: 100px;
                    left: 100px;
                }
                .third-col {
                    width: 80px;
                    min-width: 80px;
                    max-width: 80px;
                    left: 200px;
                }
                .fourth-col {
                    width: 80px;
                    min-width: 80px;
                    max-width: 80px;
                    left: 280px;
                }
            </style>
        @endsection
        <x-messages></x-messages>
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Upliftment for {{ $upliftment->company_name }} | {{ $upliftment->client_name }}</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="/eezee_batteries/client/{{ $upliftment->client_id }}"><span class="text-dark-50 font-weight-bold text-hover-primary" id="kt_subheader_total">Back to {{ $upliftment->company_name }}</span></a>
            </x-slot>
        </x-heading>
        <livewire:eezee-batteries.client.show.upliftment.book-upliftment :upliftment="$upliftment" />
    </x-container>
</x-master>