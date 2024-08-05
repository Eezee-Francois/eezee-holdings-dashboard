<div>
    <x-cards.card>
        <x-slot name="main">
            Trucks
        </x-slot>
        <x-slot name="sub">
            
        </x-slot>
        <x-slot name="toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <a href="/eezee_logistics/truck/create" class="btn btn-outline-primary font-weight-bolder">
                    </span>Create Truck</button>
                </a>
            </div>
            <!--end::Dropdown-->
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
                    <th wire:click="sortBy('name')">
                        @if($sortField != 'name')
                            <span class="font-weight-bold">Name</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Name</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Name</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('registration')">
                        @if($sortField != 'registration')
                            <span class="font-weight-bold">Registration</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Registration</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Registration</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('weight')">
                        @if($sortField != 'weight')
                            <span class="font-weight-bold">Weight</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Weight</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Weight</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                </x-slot>
    
                <x-slot name="data">
                    @forelse($trucks as $truck)
                        <tr>
                            <td width="3%"><a href="/eezee_logistics/truck/{{ $truck->id }}">{{ $truck->id }}</a></td>
                            <td width="15%">{{ $truck->name }}</td>
                            <td width="10%">{{ $truck->registration }}</td>
                            <td width="10%">{{ $truck->weight }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                        </tr>
                    @endforelse
                </x-slot>
    
            </x-template.table>
            {{ $trucks->links('vendor.pagination.tailwind') }}
        </div>
    </x-cards.card>
</div>
