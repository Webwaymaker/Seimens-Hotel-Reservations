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
						<h5>Add A New Administrator</h5>
						<p>
							<small>
								Once an adminstrator has been added an email will be sent
								to the admin's email address asking them to set thier 
								password.
							</small>
						</p>
						<form method="POST" action="/admin/add/admin">
							@csrf
							<div class="row">
								<div class="col">
									<input class="form-control @error('admin_name') is-invalid @enderror" type="text" name="admin_name" value="{{ old("admin_name") }}" placeholder="Admin Name">
									@error('admin_name')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-7">
									<input class="form-control @error('admin_email') is-invalid @enderror" type="text" name="admin_email" value="{{ old("admin_email") }}" placeholder="Admin Email Address">
									@error('admin_email')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-auto text-right">
									<button class="btn btn-primary" type="submit">Add</button>
								</div>
							</div>
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
						<h5>Add A New Report-to</h5>
						<p>
							<small>
								The new Report-to will start to recieve reports via email
								on the next automated report submission.
							</small>
						</p>
						<form method="post" action="/admin/add/report_to">
							@csrf
							<div class="row">
								<div class="col">
									<input class="form-control @error('report_to_email') is-invalid @enderror" type="text" name="report_to_email" value="{{ old("report_to_email") }}" placeholder="Report-to Email Address">
									@error('report_to_email')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-auto">
									<button class="btn btn-primary" type="submit">Add</button>
								</div>
							</div>
						</form>
					</div>
				</div>					
			</div>
	


		</div>
	</div>
</div> 
@endsection