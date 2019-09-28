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
						@if($user->protect_admin_reset_password == FALSE)
							<a class="reset-link"
								data-toggle = "modal" 
								data-target = "#model-password-reset"
								data-email  = {{ $user->email }} 
								data-route  = "/admin/password/{{ $user->access_token }}/{{ $user->id }}/reset" 
								href        = "#">
									<i class="fas fa-key"></i>
							</a>
						@endif
						&nbsp;
						@if($user->protect_admin_delete == FALSE)
							<a class="delete-link"
								data-toggle = "modal" 
								data-target = "#model-admin-delete"
								data-name   = "{{ $user->name }}"
								data-route  = "/admin/{{ $user->access_token }}/{{ $user->id }}/delete"" 
								href        = "#">
									<i class="fas fa-trash"></i>
							</a>
						@endif
					</td>
				</tr>
			@endforeach	
		</table>
	</div>
</div>

@section('model_1')
	<!-- Reset Admin Password Confirmation Model -->
	<div id="model-password-reset" class="modal" tabindex="-1" role="dialog">
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
						Are you sure you would like to send a password reset email to ...
						<div id="reset-email-address" class="font-weight-bold"></div>
					</p>
				</div>
				<div class="modal-footer">
					<form id="reset-confirm-form" action="/managment/run_report" method="GET">
						@csrf
						<button class="btn btn-danger" type="submit">Yes</button>
					</form>
					<button class="btn btn-secondary" data-dismiss="modal" type="button">No</button>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Delete Admin Confirmation Model -->
	<div id="model-admin-delete" class="modal" tabindex="-1" role="dialog">
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
						Are you sure you would like to delete the Administrator Account for ...
						<div id="delete-admin-name" class="font-weight-bold"></div>
						
					</p>
				</div>
				<div class="modal-footer">
					<form id="delete-admin-form" method="GET" action="">
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
			$('.reset-link').on("click", function() {
				$('#reset-confirm-form').attr('action', this.dataset.route);
				$('#reset-email-address').text(this.dataset.email)
			});

			$('.delete-link').on("click", function() {
				$('#delete-admin-form').attr('action', this.dataset.route);
				$('#delete-admin-name').text(this.dataset.name)
			});
		});
	</script>
@endsection

