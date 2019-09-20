<h2>Siemens - Registration Confirmation Numbers</h2>

<p>As requested, a list of all confirmation numbers registered under this email address</p> 

<table>
	<tr>
		<th style="padding: 5px; background-color: black; color: white;">Confirmation Number</th>
		<th style="padding: 5px; background-color: black; color: white;">First Name</th>
		<th style="padding: 5px; background-color: black; color: white;">Last Name</th>
		<th style="padding: 5px; background-color: black; color: white;">Location</th>
		<th style="padding: 5px; background-color: black; color: white;">Course</th>
		<th style="padding: 5px; background-color: black; color: white;">Check In Date</th>
		<th style="padding: 5px; background-color: black; color: white;">Check Out Date</th>
	</tr>
	
	@foreach($reg_conf_arr as $reg_conf)
		<tr>
			<td>
				<a href="http://ccreg.webwaymaker.com/registration/{{ $reg_conf["confirmation_num"] }}/{{ $reg_conf["id"] }}/edit">
					{{ $reg_conf["confirmation_num"] }}
				</a>
			</td>
			<td>{{ $reg_conf["first_name"] }}</td>
			<td>{{ $reg_conf["last_name"] }}</td>
			<td>{{ $reg_conf["location"] }}</td>
			<td>{{ $reg_conf["course_num"] }}</td>
			<td style="text-align: center;">{{ $reg_conf["check_in_date"] }}</td>
			<td style="text-align: center;">{{ $reg_conf["check_out_date"] }}</td>
		</tr>
	@endforeach
</table>

<p>Click on a confirmation number to edit or cancel the registration</p>
