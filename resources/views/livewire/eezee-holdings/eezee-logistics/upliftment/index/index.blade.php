<div>
    <x-cards.card>
        <x-slot name="main">
            Upliftments
        </x-slot>
        <x-slot name="sub">
            
        </x-slot>
        <x-slot name="toolbar">

        </x-slot>
        <div style="overflow-x:auto;">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-3 mt-3" placeholder="Search..." wire:model.live.debounce.200ms="search" wire:offline.attr="disabled">
                    <div wire:offline>
                        <p style="color: red;">Internet connection required...</p>
                    </div>
                </div>
            </div>
            <x-template.table>
                <x-slot name="headings">
                    <th wire:click="sortBy('id')">
                        @if($sortField != 'id') 
                            <span class="font-weight-bold">ID</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">ID</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">ID</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('client_name')">
                        @if($sortField != 'client_name')
                            <span class="font-weight-bold">Client Name</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Client Name</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Client Name</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('address')">
                        @if($sortField != 'address')
                            <span class="font-weight-bold">Address</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Address</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Address</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('province')">
                        @if($sortField != 'province')
                            <span class="font-weight-bold">Province</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Province</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Province</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th class="remove_when_mobile">
                        <span class="font-weight-bold">Weight</span>
                    </th>
                    <th class="remove_when_mobile">
                        <span class="font-weight-bold">Consultant</span>
                    </th>
                </x-slot>
    
                <x-slot name="data">
                    @forelse($upliftments as $upliftment)
                        <tr>
                            <td width="2%"><a href="/eezee_batteries/client/upliftment/{{ $upliftment->id }}">{{ $upliftment->id }}</a></td>
                            <td width="7%">{{ $upliftment->client_name }}</td>
                            <td width="17%">{{ $upliftment->address }}</td>
                            <td width="6%">{{ $upliftment->province }}</td>
                            <td width="5%">{{ $upliftment->weight }} Kg</td>
                            <td width="10%">{{ $upliftment->consultant_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                        </tr>
                    @endforelse
                </x-slot>
    
            </x-template.table>
            {{ $upliftments->links('vendor.pagination.tailwind') }}
        </div>
    </x-cards.card>
</div>
