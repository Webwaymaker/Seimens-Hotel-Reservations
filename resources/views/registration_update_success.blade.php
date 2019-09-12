@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Hotel Registration</div>

				<div class="card-body">
					<h3>Success</h3>

					<p>
						Your registration was successfully updated.
					</p>
					<p>
						A new confirmation email has been sent to you.  As a reminder 
						you will also receive another email on the Thursday before your 
						class begins.
					</p>
					<p>
						Your confirmation number is still:  <strong>{{ $confirmation_num }}</strong>
					</p>
				</div>					
			</div>
		</div>
	</div>
</div>
@endsection