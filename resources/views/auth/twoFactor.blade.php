<x-master>
    <x-container>
        <!--begin::Subheader-->
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Two Factor Authentication</h5>
            </x-slot>
            <x-slot name="sub">
                
            </x-slot>
        </x-heading>
        <!--end::Subheader-->
        <!--begin::Card-->
        <x-card>
            <x-slot name="main">
                Two Factor Authentication
            </x-slot>
            <x-slot name="sub">
                We have sent you an SMS with your Two Factor 6 digit Code. If you do not receive the SMS within 2 minutes, please click <a href="{{ route('verify.resend') }}">here</a> and we will resend your Two Factor Code.
            </x-slot>
            <x-slot name="toolbar">
                
            </x-slot>
            <form method="POST" action="{{ route('verify.store') }}">
            @csrf()
                @error('two_factor_code')
                    <div class="alert alert-custom alert-outline-2x alert-outline-primary fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">{{ $message}}</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                @enderror
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Two Factor Code<span style="color: red"> *</span></label>
                        <input type="text" class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" name="two_factor_code" placeholder="Two Factor Code" required autofocus />
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </x-card>
    </x-container>
</x-master>