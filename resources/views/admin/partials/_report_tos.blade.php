<h2 class="mb-2">Manage Report-Tos</h2>
	

@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif


<div class="card mb-4">
	<div class="card-header">Add A New Report-To</div>
	<div class="card-body">
		<p>
			The new Report-To will start to recieve reports via email
			on the next automated report submission.
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


<div class="card mb-4">
	<div class="card-header">Reports Sent To List</div>
	<div class="card-body">
		<table class="w-100">
			<tr>
				<th style="width: 90%">Report-To Email Address</th>
				<th class="text-center">Actions</th>
			</tr>
			@foreach($report_tos as $report_to)
				<tr>
					<td>{{ $report_to->email }}</td>
					<td class="text-center">
						<a class="delete-link"
							data-toggle = "modal" 
							data-target = "#model-reportTo-delete"
							data-email  = {{ $report_to->email }} 
							data-route  = "/admin/report_to/{{ $report_to->access_token }}/{{ $report_to->id }}/delete" 
							href        = "#">
								<i class="fas fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach	
		</table>
	</div>
</div>

@section('model_2')
	@include('models.model_confirmation_reportto_delete')
@endsection