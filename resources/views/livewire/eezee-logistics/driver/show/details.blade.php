<div>
	<form wire:submit.prevent="saveDriverDetails">
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>First Name<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="first_name"/>
                @error('first_name')
                    <p style="color: red;" class="pt-2">Please enter a First Name before saving</p>
                @enderror
            </div>
            <div class="col-md-6 pt-5">
                <label>Last Name<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="last_name"/>
                @error('last_name')
                    <p style="color: red;" class="pt-2">Please enter a Last Name before saving</p>
                @enderror
            </div>
        </div>
        <div wire:loading wire:target="saveDriverDetails">
		    <div class="spinner"><p class="pl-10 mt-5">Saving...</p></div>
		</div>
        @if(session()->has('driver_details_saved'))
			<a href="#" class="btn btn-outline-success mr-10 mt-5">
	    		<i class="flaticon2-check-mark"></i> Driver Details Saved
			</a>
		@endif
        <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3 mt-5" type="submit">Save</button>
	</form>
</div>
