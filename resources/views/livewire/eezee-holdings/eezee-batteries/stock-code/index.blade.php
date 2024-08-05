<div>
    <x-cards.card>
        <x-slot name="main">
            Stock Codes
        </x-slot>
        <x-slot name="sub">
            
        </x-slot>
        <x-slot name="toolbar">
            <button class="btn btn-outline-primary font-weight-bold float-right form-prevent-multiple-submits mr-3" data-toggle="modal" data-target="#addStockCode">Add Stock Code</button>
            <!-- Modal-->
            <div class="modal fade" id="addStockCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form role="form" method="POST" action="/eezee_batteries/stock/stock_code/store" class="form-prevent-multiple-submits" enctype="multipart/form-data">
                        @csrf()
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Stock Code</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Stock Code<span style="color: red"> *</span></label>
                                    <input type="text" class="form-control" id="stock_code" name="stock_code" placeholder="Battery" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary font-weight-bold">Add Stock Code</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                    <th wire:click="sortBy('stock_code')">
                        @if($sortField != 'stock_code')
                            <span class="font-weight-bold">Stock Code</span>
                        @elseif($sortDirection === 'asc')
                            <span class="text-danger font-weight-bold">Stock Code</span>
                            <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                        @else
                            <span class="text-danger font-weight-bold">Stock Code</span>
                            <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                        @endif
                    </th>
                </x-slot>
    
                <x-slot name="data">
                    @forelse($stock_codes as $stock_code)
                        <tr>
                            <td width="2%"><a href="/eezee_batteries/stock/stock_code/{{ $stock_code->id }}">{{ $stock_code->id }}</a></td>
                            <td width="7%">{{ $stock_code->stock_code }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                        </tr>
                    @endforelse
                </x-slot>
    
            </x-template.table>
            {{ $stock_codes->links('vendor.pagination.tailwind') }}
        </div>
    </x-cards.card>
</div>
