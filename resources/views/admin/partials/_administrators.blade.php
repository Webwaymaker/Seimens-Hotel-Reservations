<h2 class="mb-2">Manage Administrators</h2>
			
@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif

<div class="card mb-4">
	<div class="card-header">Add A New Adminstrator</div>
	<div class="card-body">
		<p>
			<small>
				Once an Adminstrator has been added, an email will be sent
				to the Adminstrator's email address asking them to create a 
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

<div class="card mb-4">
	<div class="card-header">Administrator List</div>
	<div class="card-body">
		<table class="w-100">
			<tr>
				<th>Name</th>
				<th>Email Address</th>
				<th class="text-center">Actions</th>
			</tr>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td class="text-center">
						<a href="/admin/{{ $user->access_token }}/{{ $user->id }}/delete">
							<i class="fas fa-pencil-alt"></i>
						</a>
						&nbsp;
						<a href="/admin/password/{{ $user->access_token }}/{{ $user->id }}/reset">
							<i class="fas fa-key"></i>
						</a>
					</td>
				</tr>
			@endforeach	
		</table>
	</div>
</div>
