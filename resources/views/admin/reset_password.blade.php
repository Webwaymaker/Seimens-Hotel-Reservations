@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Administrator Account</div>

				<div class="card-body">
					<h3>Administrator Account Password Reset</h3>

					<p>
						To reset you password for the Siemen's Hotel Registration system
						Please enter a new and matching confirmation Password. 
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
						<input type="hidden" name="access_token" value="{{ old("access_token", $admin->access_token) }}" />

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
									<small>Your new passord must be between 10 and 20 characters in length.</small>
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