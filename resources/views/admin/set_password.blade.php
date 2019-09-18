@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Account Account</div>

				<div class="card-body">
					<h3>Admin Account Password Setup</h3>

					<p>
						You have just been added to the Siemen's Hotel Registration 
						system as a site Administrator.
					</p> 

					<p>
						To finalize your activation please create a password.						
					</p>

					@if ($errors->any())
						<div class="alert alert-danger mb-4">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="mb-4" method="POST" action="/admin/set">
						@csrf

						<input type="hidden" name="id" value="{{ old("id", $admin->id) }}" />
						<input type="hidden" name="conf_num" value="{{ old("conf_num", strtotime($admin->created_at)) }}" />

						<table class="w-100">
							<tr>
								<td style="width: 25%">New Password</td>
								<td style="sidth: 75%">
									<input class="form-control" type="password" name="new_password" value="{{ old("new_password") }}" />
								</td>
							</tr>
							<tr>
								<td>Confirmation</td>
								<td>
									<input class="form-control" type="password" name="conf_password" value="{{ old("conf_password") }}" />
								</td>
							</tr>
							<tr>
								<td class="text-right" colspan="2">
									<small>Your passord must be between 10 and 20 characters in length.</small>
								</td>
							</tr>
							<tr>
								<td class="text-right" colspan="2">
									<button class="btn btn-primary" type="submit">Set Password</button>
								</td>
							</tr>
						</table>
					</form>
					
				</div>					
			</div>
		</div>
	</div>
</div>
@endsection