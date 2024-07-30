<div>
    @if (session('success_message'))
        <div class="alert alert-custom alert-outline-2x alert-outline-success fade show mb-5" role="alert">
            <div class="alert-icon"><i class="flaticon-like"></i></div>
            <div class="alert-text font-weight-bold">{{ session('success_message') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    @endif
    @if (session('fail_message'))
        <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text font-weight-bold">{{ session('fail_message') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    @endif
</div>