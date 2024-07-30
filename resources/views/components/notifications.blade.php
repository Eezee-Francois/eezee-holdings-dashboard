<div id="kt_quick_notifications" class="offcanvas offcanvas-right p-10">
	<!--begin::Header-->
	<div class="offcanvas-header d-flex align-items-center justify-content-between mb-10">
		<h3 class="font-weight-bold m-0">Notifications
		<small class="text-muted font-size-sm ml-2">{{ Auth::user()->unreadNotifications->count() }} Notifications</small></h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_notifications_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
	<!--end::Header-->
	<!--begin::Content-->
	<div class="offcanvas-content pr-5 mr-n5">
		<!--begin::Nav-->
		<div class="navi navi-icon-circle navi-spacer-x-0">
			@foreach(Auth::user()->unreadNotifications as $notification)
				<!--begin::Item-->
				@if($notification->type === 'App\Notifications\ImnEmploymentTermDone')
					<a href="/nurse/{{ $notification->data['nurse_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\LeaveformSubmitted')
					<a href="/leaveform/{{ $notification->data['leaveform_id'] }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\ClientRequestedCallbackActualNotification')
					<a href="/ticket/{{ $notification->data['ticket_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\NewPenalty')
					<a href="/nurse_penalty/{{ $notification->data['penalty_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\NursePenalty\Nurse\PenaltyNotification')
					<a href="/nurse_penalty/{{ $notification->data['penalty_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\PenaltyUpdate')
					<a href="/nurse_penalty/{{ $notification->data['penalty_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\ImnNurseDeclined')
					<a href="/nurse_penalty/{{ $notification->data['penalty_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\NursePenalty\Staff\StaffNurseDeclined')
					<a href="/nurse_penalty/{{ $notification->data['penalty_id'] }}/{{ $notification->id }}" class="navi-item">
				@elseif($notification->type === 'App\Notifications\StaffReservationBooked')
					<a href="/reservation/clear/{{ $notification->data['consultant_id'] }}/{{ $notification->id }}" class="navi-item">
				@else
					<a href="" class="navi-item">
				@endif
					<div class="navi-link rounded">
						<div class="symbol symbol-50 symbol-circle mr-3">
							<div class="symbol-label">
								<i class="flaticon-bell text-success icon-lg"></i>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold font-size-lg">{{ $notification->data['data'] }}</div>
							@if($notification->type === 'App\Notifications\ImnEmploymentTermDone')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\ClientRequestedCallbackActualNotification')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\NewPenalty')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\NursePenalty\Nurse\PenaltyNotification')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\PenaltyUpdate')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\NursePenalty\Imn\ImnNurseDeclined')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\NursePenalty\Staff\StaffNurseDeclined')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@elseif($notification->type === 'App\Notifications\StaffReservationBooked')
								<div class="text-muted">{{ $notification->data['description'] }}</div>
							@else
								<div class="text-muted"></div>
							@endif
						</div>
					</div>
				</a>
				<!--end::Item-->
			@endforeach
		</div>
		<br>
		<a href="/notification/clear" class="btn btn-light btn-hover-primary float-right">
			<i>Clear All</i>
		</a>
		<!--end::Nav-->
	</div>
	<!--end::Content-->
</div>