<h2 class="mb-2">Manage Blackouts</h2>


@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
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
					<input class="form-control @error('activate_date') is-invalid @enderror" type="text" name="activate_date" value="{{ old("activate_date") }}" placeholder="Activation Date">
					@error('activate_date')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-4">
					<input class="form-control @error('start_date') is-invalid @enderror" type="text" name="start_date" value="{{ old("start_date") }}" placeholder="Blackout Start Date">
					@error('start_date')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-4">
					<input class="form-control @error('end_date') is-invalid @enderror" type="text" name="end_date" value="{{ old("end_date") }}" placeholder="Blackout End Date">
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
							<a href="/admin/blackout/{{ $blackout->access_token }}/{{ $blackout->id }}/delete">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</td>
					</tr>
				@endforeach	
			@else
				<tr><td>&nbsp</td></tr>
				<tr>
					<td class="text-danger text-center" colspan="5">
						--- No active Blackout dates Were Found ---
					</td>
				</tr>
				<tr><td>&nbsp</td></tr>
			@endif
		</table>
	</div>
</div>
