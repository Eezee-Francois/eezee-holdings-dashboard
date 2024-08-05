<div>
    <form wire:submit.prevent="saveEmploymentTerm">
        <div class="row">
            <div class="col-md-6">
                <label>Start Date<span style="color: red"> *</span></label>
                <div class="input-group date">
                    <input type="text" class="form-control" readonly="readonly" id="kt_datepicker_1_modal" wire:model.defer="start_date" onchange="this.dispatchEvent(new InputEvent('input'))" placeholder="Start Date"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
                @error('start_date')
                    <p style="color: red;" class="pt-2">Please enter a term before saving</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label>End Date<span style="color: red"> *</span></label>
                <div class="input-group date">
                    <input type="text" class="form-control" readonly="readonly" id="kt_datepicker_2_modal" wire:model.defer="end_date" onchange="this.dispatchEvent(new InputEvent('input'))" placeholder="End Date"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>      
                @error('due_date')
                    <p style="color: red;" class="pt-2">Please enter a term before saving</p>
                @enderror  
            </div>
        </div>
        <br>
        @if(session()->has('term_saved'))
            <a href="#" class="btn btn-outline-success mr-10 fade-message">
                <i class="flaticon2-check-mark"></i> Employment Term Created
            </a>

            <script>
                $(function(){
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        @if(session()->has('already_employed'))
            <a href="#" class="btn btn-outline-danger mr-10 fade-message">
                <i class="flaticon2-cross"></i> Already Employed for this Term
            </a>

            <script>
                $(function(){
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        <button class="btn btn-outline-success float-right">Save</button>
    </form>
    <div style="overflow-x:auto;">
        <div class="row pt-10">
            <div class="col-md-6">
                <input type="text" class="form-control mb-3 mt-3" placeholder="Search..." wire:model.debounce.200ms="search" wire:offline.attr="disabled">
                <div wire:offline>
                    <p style="color: red;">Internet connection required...</p>
                </div>
            </div>
        </div>
        <!--begin: Datatable-->
        <x-template.table>
            <x-slot name="headings">
                <th wire:click="sortBy('start_date')">
                    @if($sortField != 'start_date') 
                        <span class="font-weight-bold">Start Date</span>
                    @elseif($sortDirection === 'asc')
                        <span class="text-danger font-weight-bold">Start Date</span>
                        <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                    @else
                        <span class="text-danger font-weight-bold">Start Date</span>
                        <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                    @endif
                </th>
                <th wire:click="sortBy('end_date')">
                    @if($sortField != 'end_date') 
                        <span class="font-weight-bold">End Date</span>
                    @elseif($sortDirection === 'asc')
                        <span class="text-danger font-weight-bold">End Date</span>
                        <i class="la la-long-arrow-alt-up float-right text-danger"></i>
                    @else
                        <span class="text-danger font-weight-bold">End Date</span>
                        <i class="la la-long-arrow-alt-down float-right text-danger"></i>
                    @endif
                </th>
            </x-slot>
            <x-slot name="data">
                @forelse($employment_terms as $employment_term)
                    <tr>
                        <td width="50%">{{ $employment_term->start_date }}</td>
                        <td width="50%">{{ $employment_term->end_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" style="text-align: center;" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i><h6>No Matching Results</h6></td>
                    </tr>
                @endforelse
            </x-slot>
        </x-template.table>
        {{ $employment_terms->links('vendor.pagination.tailwind') }}
    </div>
    @push('scripts')
        <script type="text/javascript">
            var KTBootstrapDatepicker = function () {

                var arrows;
                if (KTUtil.isRTL()) {
                    arrows = {
                        leftArrow: '<i class="la la-angle-right"></i>',
                        rightArrow: '<i class="la la-angle-left"></i>'
                    }
                } else {
                    arrows = {
                        leftArrow: '<i class="la la-angle-left"></i>',
                        rightArrow: '<i class="la la-angle-right"></i>'
                    }
                }
                
                // Private functions
                var demos = function () {
                    // input group layout for modal demo
                    $('#kt_datepicker_1_modal').datepicker({
                        rtl: KTUtil.isRTL(),
                        todayHighlight: true,
                        orientation: "bottom left",
                        templates: arrows,
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                    });

                    $('#kt_datepicker_2_modal').datepicker({
                        rtl: KTUtil.isRTL(),
                        todayHighlight: true,
                        orientation: "bottom left",
                        templates: arrows,
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    });
                }
                return {
                    // public functions
                    init: function() {
                        demos(); 
                    }
                };
            }();

            jQuery(document).ready(function() {    
                KTBootstrapDatepicker.init();
            });
        </script>
    @endpush
</div>