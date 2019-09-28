@extends('layouts.app')
 
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
					<div class="card">
						<div class="card-header">Hotel Registration - Update</div>
						<div class="card-body">

							<h3>Administrator - Registration Update</h3>
							
							<div class="alert alert-info">
								Please note that any changes you make here will not be 
								reported back to the individual who submitted the 
								Registration.&nbsp;  Please call and notify them of 
								the change.
							</div>
											
							<form id="update_form" method="POST" action="/registration/{{ $conf_num }}/{{ $id }}">
								@csrf
								@method("put")
								@include('registrations.partials._registration_form')
							</form>

							<form id="cancel_form" method="POST" action="/registration/{{ $conf_num }}/{{ $id }}/delete">
								@csrf
								@method("delete")
							</form>
							
							<div class="row">
								<div class="col-6">
									<button class="btn btn-danger" onClick="document.forms['cancel_form'].submit()">Cancel Registration</button>
								</div>						 
								<div class="col-6 text-right">
									<button class="btn btn-primary" onClick="document.forms['update_form'].submit()">Update Registration</button>
								</div>
							</div>

						</div>
					</div>
			</div>
			
			@if(!empty($blackout_dates[0]))
				@include('registrations.partials._blackout_dates_card')
			@endif

		</div>
	</div>
@endsection
