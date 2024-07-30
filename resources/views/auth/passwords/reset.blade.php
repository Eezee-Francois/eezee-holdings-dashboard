<x-guest>
    <x-container>
        <!--begin::Subheader-->
        <x-heading>
            <x-slot name="main">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Wrap Password Reset</h5>
            </x-slot>
            <x-slot name="sub">
                
            </x-slot>
        </x-heading>
        <!--end::Subheader-->
        <!--begin::Card-->
        <x-card>
            <x-slot name="main">
                Reset Your Password
            </x-slot>
            <x-slot name="sub">
                
            </x-slot>
            <x-slot name="toolbar">
                
            </x-slot>
                <form method="POST" action="{{ route('password.update') }}" class="pt-2">
                    @csrf()

                    <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label for="emailaddress">Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required="" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>                        
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="row">                       
                            <div class="col-md-6">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">                      
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="row">              
                            <div class="col-md-6">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                    <button type="submit" class="btn btn-success">Reset Password</button>
                </form>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted mb-0">Back to <a href="/login" class="text-dark ml-1"><b>Log in</b></a></p>
                    </div> <!-- end col -->
                </div>
            </form>
        </x-card>
    </x-container>
</x-guest>


