<div>
    <x-cards.card>
        <x-slot name="main">
            Clients
        </x-slot>
        <x-slot name="sub">
            
        </x-slot>
        <x-slot name="toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <a href="/eezee_batteries/client/create" class="btn btn-outline-primary font-weight-bolder">
                    </span>Create Client</button>
                </a>
            </div>
            <!--end::Dropdown-->
        </x-slot>
        <div style="overflow-x:auto;">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-3 mt-3" placeholder="Search..." wire:model.debounce.200ms="search" wire:offline.attr="disabled">
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
                    <th wire:click="sortBy('company_name')">
                        @if($sortField != 'company_name')
                            <span class="font-weight-bold">Company Name</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Company Name</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Company Name</span>
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
                    <th class="remove_when_mobile">
                        <span class="font-weight-bold">Contact Number</span>
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
                        <span class="font-weight-bold">Price</span>
                    </th>
                    <th class="remove_when_mobile">
                        <span class="font-weight-bold">Consultant</span>
                    </th>
                </x-slot>
    
                <x-slot name="data">
                    @forelse($clients as $client)
                        <tr>
                            <td width="3%"><a href="/eezee_batteries/client/{{ $client->id }}">{{ $client->id }}</a></td>
                            <td width="15%">{{ $client->company_name }}</td>
                            <td width="10%">{{ $client->client_name }}</td>
                            <td width="10%">{{ $client->telephone_1 }}</td>
                            <td width="8%">{{ $client->province }}</td>
                            <td width="5%">R {{ $client->price }}</td>
                            <td width="10%">{{ $client->consultant_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                        </tr>
                    @endforelse
                </x-slot>
    
            </x-template.table>
            {{ $clients->links('vendor.pagination.tailwind') }}
        </div>
    </x-cards.card>
</div>
