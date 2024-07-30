<div>
	<form wire:submit.prevent="saveTruckDetails">
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Name<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="name"/>
                @error('name')
                    <p style="color: red;" class="pt-2">Please enter a Name before saving</p>
                @enderror
            </div>
            <div class="col-md-6 pt-5">
                <label>Registration<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="registration"/>
                @error('registration')
                    <p style="color: red;" class="pt-2">Please enter the Registration before saving</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Size<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="size_with_unit"/>
                @error('size')
                    <p style="color: red;" class="pt-2">Please enter the Size before saving</p>
                @enderror
            </div>
        </div>
        <div wire:loading wire:target="saveTruckDetails">
		    <div class="spinner"><p class="pl-10 mt-5">Saving...</p></div>
		</div>
        @if(session()->has('truck_details_saved'))
			<a href="#" class="btn btn-outline-success mr-10 mt-5">
	    		<i class="flaticon2-check-mark"></i> Truck Details Saved
			</a>
		@endif
        <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3 mt-5" type="submit">Save</button>
	</form>
</div>
