<div class="card card-custom gutter-b shadow" data-card="true">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title mb-5">
			<h3 class="card-label">{{ $main }}
			<span class="d-block text-muted pt-2 font-size-sm">{{ $sub }}</span></h3>
		</div>
		<div class="d-flex align-items-center">
			<!--begin::Dropdown-->
			{{ $toolbar }}
			<!--end::Dropdown-->
		</div>
		<!--end::Toolbar-->
	</div>
	<div class="card-body pt-0">
		<span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: table"></span>
		{{ $slot }}
	</div>
</div>
<!--end::Card-->

