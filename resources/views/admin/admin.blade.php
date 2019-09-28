@extends('layouts.app')
 
@section('content')
	<div class="container">
		<div class="row justify-content-center">

			<div class="col-9">
				@if ($display == "administrators")
					@include("admin.partials._administrators")

				@elseif ($display == "report_tos")
					@include("admin.partials._report_tos")

				@elseif ($display == "blackouts")
					@include("admin.partials._blackouts")

				@else
					@include("admin.partials._registrations")
				@endif
			</div>
		
			<div class="col-3">
				<h2 class="mb-2">&nbsp;</h2>
				<div class="card mb-4">
					<div class="card-header">Manage</div>
					<div class="card-body">
						<a href="/admin/display/registrations">Reservations & Reports</a><br />
						<a href="/admin/display/administrators">Administrators</a><br />
						<a href="/admin/display/report_tos">Report-Tos</a><br />
						<a href="/admin/display/blackouts">Blackouts</a>
					</div>
				</div>

				@if(Auth::user()->id == 1)
					<div class="card mb-4">
						<div class="card-header">Developer Tools</div>
						<div class="card-body">
							<a href="/managment/clear_cache_all">Clear All Chaches</a><br />
							<a href="/managment/clear_config_cache">Clear Config Chache</a><br />
							<a href="/managment/clear_cache">Clear Chache</a><br /><br />
							<a href="#" data-toggle="modal" data-target="#model-run-report">
								Run Nightly Report
							</a>						
						</div>
					</div>
				@endif
			</div>	
	
		</div>
	</div> 
@endsection

@section('model_2')
	<div id="model-run-report" class="modal" tabindex="-1" role="dialog">
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
						Are you sure you want to run the Nightly Registration 
						Report before it's normal scheduled time?
					</p>
				</div>
				<div class="modal-footer">
					<form action="/managment/run_report" method="GET" />
						@csrf
						<button type="submit" class="btn btn-danger">Yes</button>
					</form>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
@endsection
