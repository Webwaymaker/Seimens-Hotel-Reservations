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
						Your Reservation has been canceled.&nbsp; Confirmation Number: 
						<strong>{{ $registration->confirmation_num }}<strong>
					</p>
				</div>					
			</div>
		</div>
	</div>
</div>
@endsection