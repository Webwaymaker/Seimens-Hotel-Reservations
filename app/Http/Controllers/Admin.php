<?php

namespace App\Http\Controllers;

use App\Blackout_date;
use App\Registration;
use App\Report_to;
use App\User;
use App\Mail\AdminPasswordSetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class Admin extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index(Request $request, $display = "registrations") {
		switch($display) {
			case "registrations":
				$registrations = $this->searchRegistrations($request);

				//Insures that passed search field data is displayed after submission
				$search["first_name"] = (empty($request->search_first_name)) ? NULL : $request->search_first_name; 
				$search["last_name"]  = (empty($request->search_last_name))  ? NULL : $request->search_last_name; 
				$search["check_in"]   = (empty($request->search_check_in))   ? NULL : $request->search_check_in; 
				$search["check_out"]  = (empty($request->search_check_out))  ? NULL : $request->search_check_out;
				 
				$view_data = compact("display", "registrations", "search");       
				break;
				 
			case "administrators":
				$users = User::all();
				$view_data = compact("display", "users");       
				break;

			case "report_tos":
				$report_tos = Report_to::all();
				$view_data = compact("display", "report_tos");       
				break;

			case "blackouts":
				$blackout_dates = Blackout_date::where('end_at', ">=", date("Y-m-d H:i:s"))
														 ->orderBy("start_at", "asc")
														 ->get();
				$view_data = compact("display", "blackout_dates");       
				break;
		}

		return view('admin.admin', $view_data);
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------
	
	// Search Registrations -----------------------------------------------------
	private function searchRegistrations(Request $request) {
		$first_name = (empty($request->search_first_name)) ? NULL : $request->search_first_name;
		$last_name  = (empty($request->search_last_name))  ? NULL : $request->search_last_name;
		$check_in   = (empty($request->search_check_in))   ? NULL : date("Y-m-d H:1:s", strtotime($request->search_check_in));
		$check_out  = (empty($request->search_check_out))  ? NULL : date("Y-m-d H:1:s", strtotime($request->search_check_out));
		
		$registrations = Registration::when($first_name, function($query, $first_name) {
			                           	return $query->where('first_name', 'like', '%' . $first_name . '%');
												})
												->when($last_name, function($query, $last_name) {
			                           	return $query->where('last_name', 'like', '%' . $last_name . '%');
												})
												->when($check_in, function($query, $check_in) {
			                           	return $query->where('check_in_date', ">=", $check_in);
												})
												->when($check_out, function($query, $check_out) {
			                           	return $query->where('check_in_date', "<=", $check_out);
												})
												->orderBy("check_in_date", "desc")
												->paginate(20);

		return $registrations;
	}


}  //End of Class
