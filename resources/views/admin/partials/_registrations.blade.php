@section('styles')
	<style>
		html { visibility:hidden; }
	</style>
@endsection


<h2 class="mb-2">Reservation & Reports</h2>
	
@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif


<form method="POST" action="/admin/display/registrations">
	@csrf

	<div class="card mb-4">
		<div class="card-header">Search Reservations</div>
		<div class="card-body">
			<p>
				To search the Reservation list, please enter your search criteria 
				below.
			</p>

			<div class="row mb-3">
				<div class="col-12">
					<select id="reservation_type_select" class="form-control" name="show">
						<option value="NULL"     @if(old("show", $search["show"]) == NULL)       selected='selected' @endif >Search By Reservation Type</option>
						<option value="new"      @if(old("show", $search["show"]) == "new")      selected='selected' @endif >Search Only New Reservations</option>
						<option value="old"      @if(old("show", $search["show"]) == "old")      selected='selected' @endif >Search Only Old Reservations</option> 
						<option value="both"     @if(old("show", $search["show"]) == "both")     selected='selected' @endif >Search All New And Old Reservations</option> 
						<option value="canceled" @if(old("show", $search["show"]) == "canceled") selected='selected' @endif >Search Canceled Reservations</option> 
					</select>
				</div>				
			</div>
	
			<div class="row  mb-3">
				<div class="col-6">
					<input class="form-control @error('search_first_name') is-invalid @enderror" type="text" name="search_first_name" value="{{ old("search_first_name", $search["first_name"]) }}" placeholder="Search By First Name">
					@error('search_first_name')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-6">
					<input class="form-control @error('search_last_name') is-invalid @enderror" type="text" name="search_last_name" value="{{ old("search_last_name", $search["last_name"]) }}" placeholder="Search By Last Name">
					@error('search_last_name')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
			</div>

			<div class="row  mb-3">
				<div class="col-6">
						<input class="form-control @error('search_conf_num') is-invalid @enderror" type="text" name="search_conf_num" value="{{ old("search_conf_num", $search["conf_num"]) }}" placeholder="Search By Confirmation Number">
					@error('search_conf_num')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-6">
					<input class="form-control @error('search_course_num') is-invalid @enderror" type="text" name="search_course_num" value="{{ old("search_course_num", $search["course_num"]) }}" placeholder="Search By Course Number">
					@error('search_course_num')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<button id="toggle1" class="btn btn-primary" type="button"><i class="fa fa-calendar-day"></i></button>
						</div>
						<input id="picker1" class="form-control @error('search_check_in') is-invalid @enderror" type="text" name="search_check_in" value="{{ old("search_check_in", $search["check_in"]) }}" placeholder="Search By Check In Date (MM/DD/YYYY)" autocomplete="off">
					</div>
					@error('search_check_in')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<button id="toggle2" class="btn btn-primary" type="button"><i class="fa fa-calendar-day"></i></button>
						</div>
						<input id="picker2" class="form-control @error('search_check_out') is-invalid @enderror" type="text" name="search_check_out" value="{{ old("search_check_out", $search["check_out"]) }}" placeholder="Search By Check Out Date (MM/DD/YYYY)" autocomplete="off">
					</div>
					@error('search_check_out')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>		
			</div>

			<div class="text-right">
				<button id="btn-search" class="btn btn-primary" style="width: 100px;" type="submit" name="btn_search">Search</button>
			</div>

		</div>
	</div>

	<div class="card mb-3">
		<div class="card-header">
			<div class="row">
				<div class="col-6">Reservation List</div>
				<div class="col-6 text-right">
					Showing {{ $registrations->firstItem() }} - {{ $registrations->lastItem() }}
					of {{ $registrations->total() }}
				</div>
			</div>
		</div>
		<div class="card-body">
			<table class="w-100">
				<tr>
					<th style="width: 40%">Name</th>
					<th>Course</th>
					<th class="text-center">Check In</th>
					<th class="text-center">Check Out</th>
					<th class="text-center">Actions</th>
				</tr>
				@if(!empty($registrations[0]))
					@foreach($registrations as $registration)
						<tr>
							<td>{{ $registration->first_name . " " . $registration->last_name }}</td>
							<td>{{ $registration->course_num }}</td>
							<td class="text-center">{{ date("m/d/Y", strtotime($registration->check_in_date)) }}</td>
							<td class="text-center">{{ date("m/d/Y", strtotime($registration->check_out_date)) }}</td>
							<td class="text-center">
								<a href="/registration/{{ $registration->confirmation_num }}/{{ $registration->id }}/edit/admin">
									<i class="fas fa-pencil-alt"></i>
								</a>
							</td>
						</tr>
					@endforeach		
				@else
					<tr><td>&nbsp</td></tr>
					<tr>
						<td class="text-danger text-center" colspan="5">
							--- No Reservations Were Found ---
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				@endif
			</table>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-6">
			<a class="btn btn-primary" href="/admin/display/registrations">
				Reset Reservation List
			</a>
		</div>
		<div class="col-6 d-flex justify-content-end mb-4">
			{{ 
				$registrations->onEachSide(2)
								->appends([
									"fn" => $search["first_name"],
									"ln" => $search["last_name"],
									"ci" => strtotime($search["check_in"]),
									"co" => strtotime($search["check_out"]),
									"cn" => $search['conf_num'],
									"cu" => $search['course_num'],
									"sh" => $search['show'],
								])
								->links() 
			}}
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-header">Reports</div>
		<div class="card-body">
			<p>
				To download a CSV Report of Reservation information, please complete a 
				search for the data you are looking for above and then click the 
				"Download Report" button.
			</p>

			<div class="text-right">
				<button class="btn btn-primary" type="submit" name="btn_report">Download Report</button>
			</div>
		</div>
	</div>
</form>

@include("partials._datepicker_check_in_out")

<script>
	//Fire up Jquery ------------------------------------------------------------
	$(document).ready(function(){
		//shows page after all changes have taken place.
		document.getElementsByTagName("html")[0].style.visibility = "visible";

		//On page load check type and style as placeholder if firt options is 
		//selected
		if($("#reservation_type_select").val() == "NULL") {
			applyPlaceholderStyles();
		} else {
			applyStandardStyles();
		}

		//Every time the type select box is selected style the options as standard
		//input text
		$("#reservation_type_select").focus(function() {
			applyStandardStyles();
		});

		//AFter a change is made to the type select force the focus to go to the 
		//Searc button.  This is done because the focus is not shifted if the 
		//User does not click off the select box after the change and the 
		//focusout event will not fire causing some strange styling issues.
		$("#reservation_type_select").on("change", function() {
			$("#btn-search").focus();
		});

		//After the wehre select and is change and focus shits if the first item
		//option (Null) is selected style as the list as a placeholder.  
		$("#reservation_type_select").focusout(function() {
			if($("#reservation_type_select").val() == "NULL") {
				applyPlaceholderStyles();
			}
		});
	});

	// Apply Placeholder Styles -------------------------------------------------
	function applyPlaceholderStyles() {
		$("#reservation_type_select").css({
			"height"     : "37.0313",
			"font-size"  : ".8em",
			"font-style" : "italic", 
			"color"      : "gray"
		});
	}

	// Apply Standard Styles ----------------------------------------------------
	function applyStandardStyles() {
		$("#reservation_type_select").css({
			"font-size"  : "1em",
			"font-style" : "normal", 
			"color"      : "black"
		});
	}
</script>
