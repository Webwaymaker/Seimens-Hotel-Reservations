@if(!empty($blackout_dates[0]))
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">Reserved Dates</div>
			<div class="card-body">
				<p>The following dates are not available for reservations.</p>
				@foreach($blackout_dates as $blackout_date)
					{{ $blackout_date->start_at }} &nbsp;-&nbsp; {{ $blackout_date->end_at}}
				@endforeach
			</div>
		</div>
	</div>
@endif
