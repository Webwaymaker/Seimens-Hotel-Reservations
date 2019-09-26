@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">

		<div class="col-md-3">
			<div class="card mb-4">
				<div class="card-header">Manage</div>
				<div class="card-body">
					<a href="/admin/display/registrations">Registrations & Reports</a><br />
					<a href="/admin/display/administrators">Administrators</a><br />
					<a href="/admin/display/report_tos">Report-Tos</a><br />
					<a href="/admin/display/blackouts">Blackouts</a>
				</div>
			</div>

			@if(Auth::user()->id == 1)
				<div class="card mb-4">
					<div class="card-header">Developer Tools</div>
					<div class="card-body">
						<a href="/managment/run_report">Run Nightly Report</a><br /><br />
						<a href="/managment/clear_cache_all">Clear All Chaches</a><br />
						<a href="/managment/clear_config_cache">Clear Config Chache</a><br />
						<a href="/managment/clear_cache">Clear Chache</a>
					</div>
				</div>
			@endif
		</div>

		<div class="col-md-9">
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
	</div>
</div> 
@endsection