<div>
    <x-cards.card>
        <x-slot name="main">
            Drivers
        </x-slot>
        <x-slot name="sub">
            
        </x-slot>
        <x-slot name="toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <a href="/eezee_logistics/driver/create" class="btn btn-outline-primary font-weight-bolder">
                    </span>Create Driver</button>
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
                    <th wire:click="sortBy('first_name')">
                        @if($sortField != 'first_name')
                            <span class="font-weight-bold">First Name</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">First Name</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">First Name</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('last_name')">
                        @if($sortField != 'last_name')
                            <span class="font-weight-bold">Last Name</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Last Name</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Last Name</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('drivers_license')">
                        @if($sortField != 'drivers_license')
                            <span class="font-weight-bold">Drivers License</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Drivers License</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Drivers License</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                </x-slot>
    
                <x-slot name="data">
                    @forelse($drivers as $driver)
                        <tr>
                            <td width="3%"><a href="/eezee_logistics/driver/{{ $driver->id }}">{{ $driver->id }}</a></td>
                            <td width="15%">{{ $driver->first_name }}</td>
                            <td width="15%">{{ $driver->last_name }}</td>
                            @if($driver->drivers_license)
                                <td width="10%">Yes</td>
                            @else
                                <td width="10%">No</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                        </tr>
                    @endforelse
                </x-slot>
    
            </x-template.table>
            {{ $drivers->links('vendor.pagination.tailwind') }}
        </div>
    </x-cards.card>
</div>
