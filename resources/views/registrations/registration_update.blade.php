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
									Registration updates may not process within 24 hours
									of the registration check in date. 									
								</li>
								<li>
									If you have any questions or need assistance, contact 
									SI Academy at...<br />
									<a href="mailto: smart.infrastructure.academy.us@siemens.com">
										smart.infrastructure.academy.us@siemens.com
									</a>.
								</li>
							</ul>
						</div>
										
						<form id="update_form" method="POST" action="/registration/{{ $conf_num }}/{{ $id }}">
							@csrf
							@method("put")
							@include('registrations.partials._registration_form')
						</form>

						<div class="row">
							<div class="col-6">
								<a class="delete-link btn btn-danger"
									data-toggle = "modal" 
									data-target = "#model-registration-delete"
									data-reg    = "Confirmation Number: {{ $conf_num }}"
									data-route  = "/registration/{{ $conf_num }}/{{ $id }}/delete" 
									href        = "#">
										Cancel Reservation
								</a>
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

@section('model_1')
	<!-- Cancel Confirmation Modal -->
	<div id="model-registration-delete" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>
						Are you sure you would like to delete this Reservation for ...
						<div id="delete-registration" class="font-weight-bold"></div>
					</p>
				</div>
				<div class="modal-footer">
					<form id="delete-registration-form" method="POST" action="">
						@csrf
						@method("delete")
						<button class="btn btn-danger" type="submit">Yes</button>
					</form>
					<button class="btn btn-secondary" data-dismiss="modal" type="button">No</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('.delete-link').on("click", function() {
				$('#delete-registration-form').attr('action', this.dataset.route);
				$('#delete-registration').text(this.dataset.reg)
			});
		});
	</script>
@endsection
