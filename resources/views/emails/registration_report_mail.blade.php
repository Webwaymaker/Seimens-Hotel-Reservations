<h2>@if($custom) Custom @endif Siemens Training Registration Report</h2>

<p>Hello,</p>

@if(empty($registrations))
	<p>An attempt was made to run the Siemens Training Registration Report but...</p>
	<p><strong>There are no new registrations to report for this day.</strong></p>

@else 
	<p>
		@if($custom) 
			Here is the custom Siemens Training Registration Report that you requested.
		@else
			Here is the daily Siemens Training Registration Report. 
		@endif 
	</p>

	@if(count($registrations) > 150)
		<p>
			The table of registrations is not shown in the body of this email because
			the number of registrations requested to be displayed exceeded 150.
		</p> 

	@else
		<p>
			You can click on a registrants name below to find more information.
		</p> 

		<table style="width: 100%">
			<tr>
				<th style="width: 50%; text-align: left;">Name</th>
				<th style="width: 20%; text-align: left;">Course</th>
				<th style="width: 15%">Check In Date</th>
				<th style="width: 15%">Check Out Date</th>
			</tr>

			@foreach($registrations as $registration)
				<tr>
					<td>
						<a href= "{{ $base_url }}/registration/{{ $registration["confirmation_num"] }}/{{ $registration["id"] }}/edit/admin">
							{{ $registration["first_name"] . " " . $registration["last_name"] }}
						</a>
					</td>
					<td>{{ $registration["course_num"] }}</td>
					<td style="text-align: center;">{{ $registration["check_in_date"] }}</td>
					<td style="text-align: center;">{{ $registration["check_out_date"] }}</td>
				</tr>
			@endforeach
		</table>
	@endif
@endif

<p>
	<small>
		Please do not respond to this email.&nbsp; This email box that is not 
		monitored.
	</small>
</p>
