<h2 class="mb-2">Manage Blackouts</h2>

@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif

@if (session('conflicts'))
	<div class="alert alert-danger" role="alert">
		<h4>Warning</h4>
		<p>
			The following registrants have already been scheduled during this 
			blackout.
		</p>
		<table class="w-100">
			<tr>
				<th style="width: 25%">Confirmation #</th>
				<th style="width: 30%">Name</th>
				<th style="width: 15%">Course</th>
				<th style="width: 15%" class="text-center">Check In</th>
				<th style="width: 15%" class="text-center">Check Out</th>
			</tr>
			@foreach(session('conflicts') as $conflict)
				<tr>
					<td>{{ $conflict->confirmation_num }}</td>
					<td>
						<a href="/registration/{{ $conflict->confirmation_num }}/{{ $conflict->id }}/edit/admin" target="_blank">					
							{{ $conflict->first_name . " " . $conflict->last_name }}
						</a>
					</td>
					<td>{{ $conflict->course_num }}</td>
					<td class="text-center">{{ $conflict->check_in_date }}</td>
					<td class="text-center">{{ $conflict->Check_out_date }}</td>
				</tr>	
			@endforeach
		</table>
	</div>
@endif

<div class="card mb-4">
	<div class="card-header">Add A New Blackout</div>
	<div class="card-body">
		<p>
			<small>
				To set a new Blackout, provide the activation date&nbsp; 
				(This is the date that you would first like customers to be made 
				aware of the Blackout).&nbsp; Set the start and end date of the 
				Blackout.&nbsp; Then give the Blackout a descriptor that the customer 
				will see so they can understand why the dates are not available.
			</small>
		</p>
		<form method="post" action="/admin/blackout">
			@csrf
			<input type="hidden" name="current_date" value="{{ date("m/d/Y") }}" />
			<div class="row mb-3">
				<div class="col-4">
					<div class="input-group">
						<div class="input-group-prepend">
							<button id="toggle1" class="btn btn-primary" type="button"><i class="fa fa-calendar-day"></i></button>
						</div>
						<input id="picker1" class="form-control @error('activate_date') is-invalid @enderror" type="text" name="activate_date" value="{{ old("activate_date") }}" placeholder="Activation Date (MM/DD/YYYY)" autocomplete="off">
					</div>
					@error('activate_date')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-4">
					<div class="input-group">
						<div class="input-group-prepend">
							<button id="toggle2" class="btn btn-primary" type="button"><i class="fa fa-calendar-day"></i></button>
						</div>
						<input id="picker2" class="form-control @error('start_date') is-invalid @enderror" type="text" name="start_date" value="{{ old("start_date") }}" placeholder="Start Date (MM/DD/YYYY)" autocomplete="off">
					</div>
					@error('start_date')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-4">
					<div class="input-group">
						<div class="input-group-prepend">
							<button id="toggle3" class="btn btn-primary" type="button"><i class="fa fa-calendar-day"></i></button>
						</div>
						<input id="picker3" class="form-control @error('end_date') is-invalid @enderror" type="text" name="end_date" value="{{ old("end_date") }}" placeholder="End Date (MM/DD/YYYY)" autocomplete="off">
					</div>
					@error('end_date')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
			</div>

			<div class="row">
				<div class="col">
					<input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old("description") }}" placeholder="Blackout Description">
					@error('description')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
				<div class="col-auto">
					<button class="btn btn-primary" type="submit">Add</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="card mb-4">
	<div class="card-header">Blackout Dates</div>
	<div class="card-body">
		<table class="w-100">
			<tr>
				<th class="w-50">Description</th>
				<th class="text-center">Activate Date</th>
				<th class="text-center">Start Date</th>
				<th class="text-center">End Date</th>
				<th class="text-center">Actions</th>
			</tr>
			@if(!empty($blackout_dates[0]))
				@foreach($blackout_dates as $blackout)
					<tr>
						<td>{{ $blackout->description }}</td>
						<td class="text-center">{{ $blackout->activate_at }}</td>
						<td class="text-center">{{ $blackout->start_at }}</td>
						<td class="text-center">{{ $blackout->end_at }}</td>
						<td class="text-center">
							<a class="delete-link"
								data-toggle = "modal" 
								data-target = "#model-blackout-delete"
								data-range  = "{{ $blackout->start_at }} - {{ $blackout->end_at }}"
								data-route  = "/admin/blackout/{{ $blackout->access_token }}/{{ $blackout->id }}/delete" 
								href        = "#">
									<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				@endforeach	
			@else
				<tr><td>&nbsp</td></tr>
				<tr>
					<td class="text-danger text-center" colspan="5">
						--- No active Blackout Dates Were Found ---
					</td>
				</tr>
				<tr><td>&nbsp</td></tr>
			@endif
		</table>
	</div>
</div>

@include("partials._datepicker_blackout")

@section('model_1')
	<div id="model-blackout-delete" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>
						Are you sure you would like to delete the Blackout for ...
						<div id="delete-blackout-dates" class="font-weight-bold"></div>
					</p>
				</div>
				<div class="modal-footer">
					<form id="delete-blackout-form" method="GET" action="">
						@csrf
						<button class="btn btn-danger" type="submit">Yes</button>
					</form>
					<button class="btn btn-secondary" data-dismiss="modal" type="button">No</button>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function(){
			$('.delete-link').on("click", function() {
				$('#delete-blackout-form').attr('action', this.dataset.route);
				$('#delete-blackout-dates').text(this.dataset.range)
			});
		});
	</script>
@endsection
