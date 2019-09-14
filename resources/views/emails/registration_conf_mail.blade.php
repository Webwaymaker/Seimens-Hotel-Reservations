<h2>Siemens Registration</h2>

<p>Thank you for your registration it has been successfully submitted.</p> 

<p>Your confirmation number is <strong>{{ $registration->confirmation_num }}</strong> </p>

<h3>Your Registration Details...</h3>

<table>
	<tr>
		<td>First Name: </td>
		<td>{{ $registration->first_name }}</td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td>{{ $registration->last_name }}</td>
	</tr>
	<tr>
		<td>Email Address: </td>
		<td>{{ $registration->email }}</td>
	</tr>
	<tr>
		<td>Mobile Number: </td>
		<td>{{ $registration->mobile_num }}</td>
	</tr>
	<tr>
		<td>Company Name: </td>
		<td>{{ $registration->branch }}</td>
	</tr>
	<tr>
		<td>Course Number: </td>
		<td>{{ $registration->course_num }}</td>
	</tr>
	<tr>
		<td>Check In Date: </td>
		<td>{{ $registration->check_in_date }}</td>
	</tr>
	<tr>
		<td>Check Out Data: </td>
		<td>{{ $registration->check_out_date }}</td>
	</tr>
	<tr>
		<td>Handicapped Accessible: </td>
		<td>{{ ($registration->handicapped) ? "Yes" : "No" }}</td>
	</tr>
	<tr>
		<td>Special Requests: </td>
		<td>{{ $registration->special_req }}</td>
	</tr>
</table>

<p>
	If you would like to Edit or Cancel your registration please click
	<a href="/registration/{{ $registration->confirmation_num }}/{{ $registration->id }}/edit">Here</a>.
</p>

<p>Enjoy your stay!</p>
