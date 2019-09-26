@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
				<div class="text-right mb-2">
					<a href="/registration_login">Click to modify or delete an existing Registration</a>
				</div>
				
				<div class="card">
					<div class="card-header">Hotel Registration</div>
					<div class="card-body">
					  <div class="alert alert-info">
							<h3>Important</h3>
							<ul>
								<li>
									For our Customers and Partners, please complete this form to
									make hotel reservations. <u>You will receive a confirmation
									email on the Thursday before your class begins</u>.
								</li>

								<li>
									If you are a Siemens SI US or Canada employee attending 
									a class at the Buffalo Grove, IL Training facility, 
									<strong>DO NOT</strong> complete this form. Your hotel
									reservations will automatically be made for you. 
								</li>

								<li>
									For questions, contact SI Academy at
									<a href="mailto: smart.infrastructure.academy.us@siemens.com">
										smart.infrastructure.academy.us@siemens.com
									</a>
								</li>
							</ul>
						</div>
										  
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form method="POST" action="/registration">
							@csrf

							@include('registrations.partials._registration_form')

							<div class="text-right">
								<button class="btn btn-primary" type="submit" name="btn_edit">Register</button> 
							</div>
						</form>
					 </div>
					 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker();
	});
</script>
@endsection