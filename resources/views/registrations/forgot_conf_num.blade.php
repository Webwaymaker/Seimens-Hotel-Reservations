@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">My Reservations</div>

				<div class="card-body">
					<h3>Confirmation Number Recovery</h3>

					<p>
						To recover your confirmation number(s) please enter your email address 
						below.&nbsp; All Reservation confirmation numbers that are associated 
						to the entered email address will be sent to this email address.
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

					@if(isset($invalid))
						<div class="alert alert-danger mb-4">
							The email address you entered was not found.&nbsp; Please 
							check the spelling of the email address or enter a new 
							email address.  
						</div>	
					@endif

					<form method="POST" action="/forgot">
						@csrf

						<table class="w-100">
							<tr>
								<td width="30%">Email Address</td>
								<td width="70%">
									<input class="form-control" type="text" name="email" value="{{ old('email', (isset($email)) ? $email : '') }}">
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>							

							<tr>
								<td class="text-right" colspan="2">
									<button class="btn btn-primary" type="submit">Recover</div>
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