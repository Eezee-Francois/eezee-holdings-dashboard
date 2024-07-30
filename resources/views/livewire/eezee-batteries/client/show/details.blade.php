<div>
	<form wire:submit.prevent="saveClientDetails">
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Company<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="company_name"/>
                @error('company_name')
                    <p style="color: red;" class="pt-2">Please enter a Company before saving</p>
                @enderror
            </div>
            <div class="col-md-6 pt-5">
                <label>Client Name</label>
                <input type="text" class="form-control" wire:model.defer="client_name"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Telephone Number<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="telephone_1"/>
                @error('telephone_1')
                    <p style="color: red;" class="pt-2">Please enter a Telephone Number before saving</p>
                @enderror
            </div>
            <div class="col-md-6 pt-5">
                <label>Secondary Telephone Number</label>
                <input type="text" class="form-control" wire:model.defer="telephone_2"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Email Address</label>
                <input type="email" class="form-control" wire:model.defer="email"/>
                @error('email')
                    <p style="color: red;" class="pt-2">Please enter an Email Address before saving</p>
                @enderror
            </div>
            <div class="col-md-6 pt-5">
                <label>Price<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="price"/>
                @error('price')
                    <p style="color: red;" class="pt-2">Please enter a Price before saving</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-5">
                <label>Province<span style="color: red"> *</span></label>
                <input type="text" class="form-control" wire:model.defer="province"/>
                @error('province')
                    <p style="color: red;" class="pt-2">Please enter a Province before saving</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-5">
                <label>Client Comments</label>
                <textarea class="form-control" wire:model.defer="client_comments"></textarea>
            </div>
        </div>
        <div wire:loading wire:target="saveClientDetails">
		    <div class="spinner"><p class="pl-10 mt-5">Saving...</p></div>
		</div>
        @if(session()->has('client_details_saved'))
			<a href="#" class="btn btn-outline-success mr-10 mt-5">
	    		<i class="flaticon2-check-mark"></i> Client Details Saved
			</a>
		@endif
        <button class="btn btn-success font-weight-bold float-right form-prevent-multiple-submits mr-3 mt-5" type="submit">Save</button>
	</form>
</div>
