@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Hotel Reservations</div>

				<div class="card-body">
					<h3>Error</h3>

					<p>
						An error occurred while updating your Reservation please
						contact								
						<a href="mailto: smart.infrastructure.academy.us@siemens.com">
							smart.infrastructure.academy.us@siemens.com
						</a>
						for assistance.
					</p>
					
					@include('partials._back_buttons')
				</div>					
			</div>
		</div>
	</div>
</div>
@endsection