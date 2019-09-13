@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
				<div class="card">
					<div class="card-header">Hotel Registration - Update</div>
					<div class="card-body">
					  <div class="alert alert-info">
							<h3>Important</h3>
							<ul>
								<li>
									Registrations updates may not process if within 24 hours
									of the registration's check in date. 									
								</li>

								<li>
									If you have any questions or need assistance, contact 
									BT University at ...<br />
									<a href="mailto: btuniversity.i-bt@siemens.com">btuniversity.i-bt@siemens.com</a>.
								</li>

								<li>
									If youwould like to cancel your registration please click here
									<form method="POST" action="/registration/{{ $conf_num }}/{{ $id }}/delete">
										@csrf
										@method("delete")
										<button class="btn btn-danger mt-2" type="submit" name="btn_cancel">Cancel Registration</button> 
									</form>
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

						<form method="POST" action="/registration/{{ $conf_num }}/{{ $id }}">
							@csrf
							@method("put")

							@include('_registration_form')

							<div class="text-right">
								<button class="btn btn-primary" type="submit" name="btn_update">Update Registration</button> 
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