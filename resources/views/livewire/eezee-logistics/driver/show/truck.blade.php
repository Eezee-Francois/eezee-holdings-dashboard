<div>
    <form wire:submit.prevent="addTruck">
        <div class="row">
            <div class="col-md-6">
                <label>Truck<span style="color: red"> *</span></label>
                <select class="custom-select" wire:model.defer="truck_id">
                    <option value="" selected hidden>Select Truck...</option>
                    <option value="All Trucks">All Trucks</option>
                    @foreach ($trucks as $truck)
                        <option value="{{ $truck->id }}">{{ $truck->name }}</option>
                    @endforeach
                </select>
                @error('truck_id')
                    <p class="pt-2" style="color: red">Please Choose a Truck First</p>
                @enderror
            </div>
        </div>
        <br>
        @if (session()->has('all_trucks_added'))
            <a href="#" class="btn btn-outline-success mr-10 fade-message">
                <i class="flaticon2-check-mark"></i> All Trucks Added
            </a>

            <script>
                $(function() {
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        @if (session()->has('truck_removed'))
            <a href="#" class="btn btn-outline-success mr-10 fade-message">
                <i class="flaticon2-check-mark"></i> Truck Removed
            </a>

            <script>
                $(function() {
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        @if (session()->has('truck_added'))
            <a href="#" class="btn btn-outline-success mr-10 fade-message">
                <i class="flaticon2-check-mark"></i> Truck Added
            </a>

            <script>
                $(function() {
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        @if (session()->has('exists'))
            <a href="#" class="btn btn-outline-danger mr-10 fade-message">
                <i class="flaticon2-cross"></i> Driver is already added to this Truck
            </a>

            <script>
                $(function() {
                    setTimeout(function() {
                        $('.fade-message').fadeOut();
                    }, 5000);
                });
            </script>
        @endif
        <button class="btn btn-outline-success float-right" type="submit">Save</button>
    </form>
    <div class="pt-10" style="overflow-x:auto;">
        <x-template.table>
            <x-slot name="headings">
                <th>
                    <span class="font-weight-bold">Truck</span>
                </th>
                <th>
                    <span class="font-weight-bold">Actions</span>
                </th>
            </x-slot>
            <x-slot name="data">
                @forelse($driver->trucks as $truck)
                    <tr>
                        <td width="50%">{{ $truck->name }}</td>
                        <td>
                            <button type="submit" class="btn btn-outline-danger button-prevent-multiple-submits" wire:click="removeTruck('{{ $truck->id }}')">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" style="text-align: center" class="font-weight-bold"><i class="fas fa-inbox pr-1 text-dark icon-lg"></i>
                            <h6>No Matching Results</h6>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-template.table>
    </div>
</div>
