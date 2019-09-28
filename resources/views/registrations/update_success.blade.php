@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Hotel Reservations</div>

				<div class="card-body">
					<h3>Success</h3>

					<p>
						Your Reservation was successfully updated.
					</p>
					<p>
						A new confirmation email has been sent to you.  As a reminder 
						you will also receive another email on the Thursday before your 
						class begins.
					</p>
					<p>
						Your confirmation number is still:  <strong>{{ $registration->confirmation_num }}</strong>
					</p>
					<p>
						If you would like to continue to modify or cancel your Reservation please click 
						<a href="/registration/{{ $registration->confirmation_num }}/{{ $registration->id }}/edit">
							Here
						</a>.	
					</p>
					
					@include('partials._back_buttons')
				</div>					
			</div>
		</div>
	</div>
</div>
@endsection