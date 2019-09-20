@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif

			@if (session('conflicts'))
				<div class="alert alert-danger" role="alert">
					<h3>Registration Conflicts</h3>
					
					<p>
						Bellow is a list of current pending registrations that conflict
						with your new Blackout.
					</p>

					<table class="w-100">
						<tr>
							<th class="w-25">Registration Under</th>
							<th class="w-25 text-center">Confirmation #</th>
							<th class="w-25 text-center">Check In Date</th>
							<th class="w-25 text-center">Check Out Date</th>
						</tr>
						@foreach(session('conflicts') as $conflict)
							<tr>
								<td>{{ $conflict->first_name . " " . $conflict->last_name }}</td>
								<td class="text-center">{{ $conflict->confirmation_num }}</td>
								<td class="text-center">{{ $conflict->check_in_date }}</td>
								<td class="text-center">{{ $conflict->check_out_date }}</td>
							</tr>
						@endforeach
					</table>
				</div>
			@endif

			<div class="card mb-4">
				<div class="card-header">Adminstrators</div>
				<div class="card-body">
					<table class="w-100 mb-3">
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td class="text-right">
									<a href="/admin/password/{{ $user->access_token }}/{{ $user->id }}/reset">R</a>
									&nbsp;
									<a href="/admin/{{ $user->access_token }}/{{ $user->id }}/delete">X</a>
								</td>
							</tr>
						@endforeach	
					</table>
					<hr>
					<div>
						<h5>Add A New Administrator</h5>
						<p>
							<small>
								Once an adminstrator has been added an email will be sent
								to the admin's email address asking them to set thier 
								password.
							</small>
						</p>
						<form method="POST" action="/admin/add/admin">
							@csrf
							<div class="row">
								<div class="col">
									<input class="form-control @error('admin_name') is-invalid @enderror" type="text" name="admin_name" value="{{ old("admin_name") }}" placeholder="Admin Name">
									@error('admin_name')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-7">
									<input class="form-control @error('admin_email') is-invalid @enderror" type="text" name="admin_email" value="{{ old("admin_email") }}" placeholder="Admin Email Address">
									@error('admin_email')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-auto text-right">
									<button class="btn btn-primary" type="submit">Add</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


			<div class="card mb-4">
				<div class="card-header">Reports Sent To</div>
				<div class="card-body">
					<table class="w-100 mb-3">
						@foreach($report_tos as $report_to)
							<tr>
								<td>{{ $report_to->email }}</td>
								<td class="text-right">
									<a href="/admin/report_to/{{ $report_to->access_token }}/{{ $report_to->id }}/delete">X</a>
								</td>
							</tr>
						@endforeach	
					</table>
					<hr>
					<div>
						<h5>Add A New Report-to</h5>
						<p>
							<small>
								The new Report-to will start to recieve reports via email
								on the next automated report submission.
							</small>
						</p>
						<form method="post" action="/admin/add/report_to">
							@csrf
							<div class="row">
								<div class="col">
									<input class="form-control @error('report_to_email') is-invalid @enderror" type="text" name="report_to_email" value="{{ old("report_to_email") }}" placeholder="Report-to Email Address">
									@error('report_to_email')
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
			</div>
	

			<div class="card mb-4">
				<div class="card-header">Blackout Dates</div>
				<div class="card-body">
					<table class="w-100 mb-3">
						<tr>
							<th class="w-50">Description</th>
							<th class="text-center">Activate Date</th>
							<th class="text-center">Start Date</th>
							<th class="text-center">End Date</th>
							<th>&nbsp;</th>
						</tr>
						@foreach($blackout_dates as $blackout)
							<tr>
								<td>{{ $blackout->description }}</td>
								<td class="text-center">{{ $blackout->activate_at }}</td>
								<td class="text-center">{{ $blackout->start_at }}</td>
								<td class="text-center">{{ $blackout->end_at }}</td>
								<td class="text-right">
									<a href="/admin/blackout/{{ $blackout->access_token }}/{{ $blackout->id }}/delete">X</a>
								</td>
							</tr>
						@endforeach	
					</table>
					<hr>
					<div>
						<h5>Add A New Blackout</h5>
						<p>
							<small>
								To set a new Blackout provide the activation date.&nbsp; 
								The date that you would blackout would be displayed.&nbsp;
								Set the start and end date of the Blackout.&nbsp; Then 
								give the Blackout a descriptor that the customer will see 
								so they can understand why the dates are not available.
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
			</div>
	
		</div>
	</div>
</div> 
@endsection