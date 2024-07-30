<div id="kt_quick_actions" class="offcanvas offcanvas-right p-10">
	<!--begin::Header-->
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-10">
		<h3 class="font-weight-bold m-0">Quick Actions</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_actions_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
	<!--end::Header-->
	<!--begin::Content-->
	<div class="offcanvas-content pr-5 mr-n5">
		@role('Nurse')
		<div class="row gutter-b">
			<!--begin::Item-->
			<div class="col-6">
				<a href="/tickets/today" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
					<span class="svg-icon svg-icon-3x svg-icon-primary m-0">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Euro.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect x="0" y="0" width="24" height="24"/>
						        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
						        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
						        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
						        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
						    </g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="d-block font-weight-bold font-size-h6 mt-2">Today's Appointments</span>
				</a>
			</div>
			<!--end::Item-->
		</div>
		@endrole
		@role('Admin|Beautician')
		<div class="row gutter-b">
			<!--begin::Item-->
			<div class="col-6">
				<a href="/iv_client_file/create" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
					<span class="svg-icon svg-icon-3x svg-icon-primary m-0">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Euro.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24"/>
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="d-block font-weight-bold font-size-h6 mt-2">Walk in IV Client</span>
				</a>
			</div>
			<!--end::Item-->
		</div>
		@endrole
		@role('Admin|AWS')
			<div class="row gutter-b">
				<!--begin::Item-->
				<div class="col-6">
					<a href="/contact_control_panel" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5">
						<span class="svg-icon svg-icon-3x svg-icon-primary m-0">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Euro.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"/>
									<path d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z" fill="#000000"/>
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<span class="d-block font-weight-bold font-size-h6 mt-2">CCP</span>
					</a>
				</div>
				<!--end::Item-->
			</div>
		@endrole
	</div>
	<!--end::Content-->
</div>