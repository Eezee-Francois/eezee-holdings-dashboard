<x-master>
    <x-container>
        <x-messages></x-messages>
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Eezee Batteries | Stock</h5>
            </x-slot>
            <x-slot name="sub">
                <a href="/home"><span class="text-dark-50 font-weight-bold text-hover-primary" id="kt_subheader_total">Dashboard</span></a>
            </x-slot>
        </x-heading>
        <livewire:eezee-holdings.eezee-batteries.stock.stock-code.index/>
    </x-container>
</x-master>