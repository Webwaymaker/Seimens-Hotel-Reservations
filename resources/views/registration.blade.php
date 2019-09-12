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
										email on the Thursday before your class beings</u>.
								</li>
								<li>
									If you are a Siemens BT or Siemens Canada employee,
									<span style="font-weight: bold;">DO NOT</span> complete this form. Your
									hotel reservations will automatically be made for you.
								</li>
								<li>
									For questions, contact BT University at
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

						<form method="POST" action="/registration">
							@csrf

							<table width="100%">
								<tr>
									<td>First Name</td>
									<td>
										<input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}">
									</td>
								</tr>
								<tr>
									<td>Last Name</td>
									<td>
										<input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
									</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>
										<input class="form-control" type="text" name="email" value="{{ old('email') }}">
									</td>
								</tr>
								<tr>
									<td>Mobile Number</td>
									<td>
										<input class="form-control" type="text" name="mobile_num" value="{{ old('mobile_num') }}">
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>

								<tr>
									<td>Company Name</td>
									<td>
										<input class="form-control" type="text" name="branch" value="{{ old('branch') }}">
									</td>
								</tr>
								<tr>
									<td>Course Number</td>
									<td>
										<input class="form-control" type="text" name="course_num" value="{{ old('course_num') }}">
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>

								<tr>
									<td>Check In Date</td>
									<td>
										<div class='input-group date' id='datetimepicker1'>
											<input class="form-control" type="text" name="check_in_date" value="{{ old('check_in_date') }}">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-time"></span>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>Check Out Date</td>
									<td>
										<input class="form-control" type="text" name="check_out_date" value="{{ old('check_out_date') }}">
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>

								<tr>
									<td>Special Requests</td>
									<td>
										<textarea class="form-control" name="special_req">{{ old('special_req') }}</textarea>
									</td>
								</tr>
								<tr>
									<td>Handicapped Accessable</td>
									<td>
										<select class="form-control" name="handicapped">
											<option value="0" {{ old("handicapped") == 0 ? 'selected' : ''}}>No</option>
											<option value="1" {{ old("handicapped") == 1 ? 'selected' : ''}}>Yes</option>
										</select>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>

								<tr>
									<td>
										<button class="btn btn-primary" type="submit" name="btn_submit">Submit</button> 
									</td>
								</tr>
							</table>
						</form>
					 </div>
					 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
</script>
@endsection