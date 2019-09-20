<table width="100%">
	<tr>
		<td>First Name</td>
		<td>
			<input class="form-control" type="text" name="first_name" value="{{ old('first_name', (isset($reg_data->first_name)) ? $reg_data->first_name : '') }}">
		</td>
	</tr>
	<tr>
		<td>Last Name</td>
		<td>
			<input class="form-control" type="text" name="last_name" value="{{ old('last_name', (isset($reg_data->last_name)) ? $reg_data->last_name : '') }}">
		</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>
			<input class="form-control" type="text" name="email" value="{{ old('email', (isset($reg_data->email)) ? $reg_data->email : '') }}">
		</td>
	</tr>
	<tr>
		<td>Mobile Number</td>
		<td>
			<input class="form-control" type="text" name="mobile_num" value="{{ old('mobile_num', (isset($reg_data->mobile_num)) ? $reg_data->mobile_num : '') }}">
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>Company Name</td>
		<td>
			<input class="form-control" type="text" name="location" value="{{ old('location', (isset($reg_data->location)) ? $reg_data->location : '') }}">
		</td>
	</tr>
	<tr>
		<td>Course Number</td>
		<td>
			<input class="form-control" type="text" name="course_num" value="{{ old('course_num', (isset($reg_data->course_num)) ? $reg_data->course_num : '') }}">
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>Check In Date</td>
		<td>
			<input class="form-control" type="text" name="check_in_date" value="{{ old('check_in_date', (isset($reg_data->check_in_date)) ? $reg_data->check_in_date : '') }}">
		</td>
	</tr>
	<tr>
		<td>Check Out Date</td>
		<td>
			<input class="form-control" type="text" name="check_out_date" value="{{ old('check_out_date', (isset($reg_data->check_out_date)) ? $reg_data->check_out_date : '') }}">
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>Special Requests</td>
		<td>
			<textarea class="form-control" name="special_req">{{ old('special_req', (isset($reg_data->special_req)) ? $reg_data->special_req : '') }}</textarea>
		</td>
	</tr>
	<tr>
		<td>Handicapped Accessable</td>
		<td>
			<select class="form-control" name="handicapped">
				<option value="0" {{ old("handicapped", (isset($reg_data->handicapped)) ? $reg_data->handicapped : -1) == 0 ? 'selected' : '' }}>No</option>
				<option value="1" {{ old("handicapped", (isset($reg_data->handicapped)) ? $reg_data->handicapped : -1) == 1 ? 'selected' : '' }}>Yes</option>
			</select>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>
