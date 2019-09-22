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
    </div>
</div>

<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker();
	});
</script>
@endsection