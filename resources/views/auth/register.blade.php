<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!--begin::Head-->
    <head><base href="../../../">
        <meta charset="utf-8" />
        <title>Eezee Holdings | Register</title>
        <meta name="description" content="Login page example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
        <link href="{{ asset('/assets/css/pages/login/login-2.css?v=7.0.4') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('/assets/plugins/global/plugins.bundle.css?v=7.0.4') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.4') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/css/style.bundle.css?v=7.0.4') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="{{ asset('/assets/media/logos/favicon.ico') }}" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-static page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                    <!--begin: Aside Container-->
                    <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                        <!--begin::Logo-->
                        <a href="/" class="text-center pt-2">
                            <img src="{{ asset('/logos/grey.png') }}" class="max-h-100px" alt="" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Aside body-->
                        <div class="d-flex flex-column-fluid flex-column flex-center">
                            <!--begin::Signin-->
                            <div class="login-form login-signin py-11">
                                <!--begin::Form-->
                                <form class="form" method="POST" action="{{ route('register') }}">
                                @csrf
                                    <!--begin::Title-->
                                    <div class="text-center pb-8">
                                        <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign Up</h2>
                                        <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
                                    </div>
                                    <!--end::Title-->
                                    @error('name')
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
                                    @error('email')
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
                                    @error('phone_number')
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
                                    @error('password')
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
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('name') is-invalid @enderror" type="text" placeholder="First Name" name="name" id="name" value="{{ old('name') }}" autocomplete="name" required/>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" />
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone_number') is-invalid @enderror" type="text" placeholder="Telephone" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" min="10" required autocomplete="phone_number" />
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" id="password" required autocomplete="off" />
                                        <br>
                                        Passwords should contain atleast: <br> 1 Uppercase, <br> 1 Lowercase, <br> 1 Special Character ('@', '#', '$', '%') <br> 8 characters or longer
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="password_confirmation" id="password-confirm" autocomplete="off" required />
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <label class="checkbox mb-0">
                                        <input type="checkbox" name="agree" required/>I Agree to the
                                        <a href="/terms">terms and conditions</a>
                                        <span></span></label>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                                        <button type="submit" class="btn btn-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Submit</button>
                                        <a href="/" class="btn btn-secondary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</a>
                                    </div>
                                    <!--end::Form group-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Signin-->
                        </div>
                        <!--end::Aside body-->
                    </div>
                    <!--end: Aside Container-->
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
                    <!--begin::Title-->
                    <div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
                        <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Whips Realtime Action Platform<br/>For Medicals</h3>
                    </div>
                    <!--end::Title-->
                    <!--begin::Image-->
                    <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(/assets/media/svg/illustrations/login-visual-2.svg);"></div>
                    <!--end::Image-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->
        <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{ asset('/assets/plugins/global/plugins.bundle.js?v=7.0.4') }}"></script>
        <script src="{{ asset('/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4') }}"></script>
        <script src="{{ asset('/assets/js/scripts.bundle.js?v=7.0.4') }}"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{ asset('/assets/js/pages/custom/login/login-general.js?v=7.0.4') }}"></script>
        <!--end::Page Scripts-->
    </body>
    <!--end::Body-->
</html>