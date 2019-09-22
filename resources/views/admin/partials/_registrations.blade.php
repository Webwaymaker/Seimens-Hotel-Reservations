<h2 class="mb-2">Registrations & Reports</h2>
	

@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif


<div class="card mb-4">
	<div class="card-header">Search Registration</div>
	<div class="card-body">
		<p>
			To search the Registration List please enter your search criteria below 
			- Name, Check In Date and/or Check Out Date.
		</p>
		<form method="POST" action="/admin/display/registrations">
			@csrf
			<div class="row  mb-3">
				<div class="col-5">
					<input class="form-control @error('search_first_name') is-invalid @enderror" type="text" name="search_first_name" value="{{ old("search_first_name", $search["first_name"]) }}" placeholder="Search First Name">
					@error('search_first_name')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-5">
					<input class="form-control @error('search_last_name') is-invalid @enderror" type="text" name="search_last_name" value="{{ old("search_last_name", $search["last_name"]) }}" placeholder="Search Last Name">
					@error('search_last_name')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-auto">
					<button class="btn btn-primary" style="width: 100px;" type="submit">Search</button>
				</div>
			</div>

			<div class="row">
				<div class="col-5">
					<input class="form-control @error('search_check_in') is-invalid @enderror" type="text" name="search_check_in" value="{{ old("search_check_in", $search["check_in"]) }}" placeholder="Search Check In Date">
					@error('search_check_in')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-5">
					<input class="form-control @error('search_check_out') is-invalid @enderror" type="text" name="search_check_out" value="{{ old("search_check_out", $search["check_out"]) }}" placeholder="Search Check Out Date">
					@error('search_check_out')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
		
				<div class="col-auto">
					<a class="btn btn-success" style="width: 100px;" href="/admin/display/registrations">Reset</a>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="card mb-3">
	<div class="card-header">
		<div class="row">
			<div class="col-6">Registration List</div>
			<div class="col-6 text-right">
				Showing {{ $registrations->firstItem() }} - {{ $registrations->lastItem() }}
				of {{ $registrations->total() }}
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="w-100">
			<tr>
				<th class="w-50">Name</th>
				<th class="text-center">Check In</th>
				<th class="text-center">Check Out</th>
				<th class="text-center">Actions</th>
			</tr>
			@if(!empty($registrations[0]))
				@foreach($registrations as $registration)
					<tr>
						<td>{{ $registration->first_name . " " . $registration->last_name }}</td>
						<td class="text-center">{{ date("m/d/Y", strtotime($registration->check_in_date)) }}</td>
						<td class="text-center">{{ date("m/d/Y", strtotime($registration->check_out_date)) }}</td>
						<td class="text-center">
							<a href="/registration/{{ $registration->confirmation_num }}/{{ $registration->id }}/edit/admin">E</a>
						</td>
					</tr>
				@endforeach		
			@else
				<tr><td>&nbsp</td></tr>
				<tr>
					<td class="text-danger text-center" colspan="5">
						--- No Registrations Were Found ---
					</td>
				</tr>
				<tr><td>&nbsp</td></tr>
			@endif
		</table>
	</div>
</div>

<div class="d-flex justify-content-end mb-4">
	{{ 
		$registrations->onEachSide(2)
						  ->appends([
							  "fn" => $search["first_name"],
							  "ln" => $search["last_name"],
							  "ci" => strtotime($search["check_in"]),
							  "co" => strtotime($search["check_out"]),
						  ])
						  ->links() 
	}}
</div>



<div class="card mb-4">
	<div class="card-header">Reports</div>
	<div class="card-body">
		<p>
			To download a CSV Report of Registration information please complete a 
			search for the data you are looking for above and then click the 
			"Download Report" button.
		</p>

		<div class="text-right">
			<button class="btn btn-primary" type="search">Download Report</div>
		</div>
	</div>
</div>
	