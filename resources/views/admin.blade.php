@extends('layouts.app')
 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			<div class="card mb-4">
				<div class="card-header">Admins</div>
				<div class="card-body">
					<table class="w-100 mb-3">
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td class="text-right">
									<a href="">X</a>
									&nbsp;
									<a href="">R</a>
								</td>
							</tr>
						@endforeach	
					</table>
					<hr>
					<div>
						<h4>Add A New Administrator</h4>
						<p>
							<small>
								Once an adminstrator has been added an email will be sent
								to the admin's email address asking them to set thier 
								password.
							</small>
						</p>
						<form class="form-inline" method="post" action="/admin/add/admin">
							@csrf
							<input class="form-control mr-3 mb-2" style="width: 35%" type="text" name="admin_name" placeholder="Admin Name">
							<input class="form-control mr-3 mb-2" style="width: 50%" type="text" name="admin_email" placeholder="Admin Email Address">
							<button class="btn btn-primary mb-2" type="submit">Add</button>
						</form>
					</div>
				</div>
			</div>


			<div class="card mb-4">
				<div class="card-header">Reports Sent To</div>
				<div class="card-body">
					<table class="w-100 mb-3">
						@foreach($report_tos as $report_to)
							<tr>
								<td>{{ $report_to->email }}</td>
								<td class="text-right">
									<a href="">X</a>
								</td>
							</tr>
						@endforeach	
					</table>
					<hr>
					<div>
						<h4>Add A New Report-to</h4>
						<p>
							<small>
								The new Report-to will start to recieve reports via email
								on the next automated report submission.
							</small>
						</p>
							<form class="form-inline" method="post" action="/admin/add/report_to">
							@csrf
							<input class="form-control mr-3 mb-2" style="width: 87%" type="text" name="report_to_email" placeholder="Report-to Email Address">
							<button class="btn btn-primary mb-2" type="submit">Add</button>
						</form>
					</div>
				</div>					
			</div>
	


		</div>
	</div>
</div> 
@endsection