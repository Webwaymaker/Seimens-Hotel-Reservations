<?php

namespace App\Http\Controllers;

use App\Blackout_date;
use App\Registration;
use App\Report_to;
use App\User;
use App\Mail\AdminPasswordSetMail;
use App\Mail\RegistrationReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class Admin extends Controller {


//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	private $search = [
		'first_name' => NULL, 
		'last_name'  => NULL, 
		'check_in'   => NULL,
		'check_out'  => NULL,
	];


//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index(Request $request, $display = "registrations") {
		switch($display) {
			case "registrations":
				$this->setSearchFields($request);
				$search        = $this->search;
				$registrations = $this->getPaginatedRegistrations();
				
				//check for report run request and send the report
				if($request->has("btn_report")) {
					$all_registrations = $this->getAllRegistrations();
					Mail::to(auth()->user()->email)->send(new RegistrationReportMail($all_registrations, TRUE));
					session()->flash("status", "A report has been created based off of your search criteria and sent to " . auth()->user()->email);
				}

				$view_data = compact("display", "search", "registrations");      
				break;
				 
			case "administrators":
				$users = User::all();
//dd($users[5]->protect_admin_delete);
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
	
	// Get All  Registrations ---------------------------------------------------
	// I hate doubling up methods like this but i could not find a solution for 
	// Putting a get and a pagination query into one function with the time
	// limit I have
	private function getAllRegistrations() {
		//Not sure why but the "When" clouser will not accept an Array but it will 
		//accept an explicit variable.  So broke the proprty into explicit variables.
		$first_name = $this->search["first_name"];
		$last_name  = $this->search["last_name"];
		$check_in   = $this->search["check_in"];
		$check_out  = $this->search["check_out"];

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
												->whereNull('canceled_at')
												->orderBy("check_in_date", "desc")
												->get()
												->toArray();

		return $registrations;
	}

	// Get paginated Registrations ----------------------------------------------
	// I hate doubling up methods like this but i could not find a solution for 
	// Putting a get and a pagination query into one function with the time
	// limit I have
	private function getPaginatedRegistrations() {
		//Not sure why but the "When" clouser will not accept an Array but it will 
		//accept an explicit variable.  So broke the proprty into explicit variables.
		$first_name = $this->search["first_name"];
		$last_name  = $this->search["last_name"];
		$check_in   = $this->search["check_in"];
		$check_out  = $this->search["check_out"];

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
												->whereNull('canceled_at')
												->orderBy("check_in_date", "desc")
												->paginate(20);

		return $registrations;
	}



	//Set Search Fields ---------------------------------------------------------
	private function setSearchFields(Request $request) {
		if($request->fn) {
			$this->search["first_name"] = $request->fn;
		} else {
			$this->search["first_name"] = (empty($request->search_first_name)) ? NULL : $request->search_first_name;
		}

		if($request->ln) {
			$this->search["last_name"]  = $request->ln;
		} else {
			$this->search["last_name"]  = (empty($request->search_last_name))  ? NULL : $request->search_last_name;
		}

		if($request->ci) {
			$this->search["check_in"]   = date("Y-m-d H:1:s", $request->ci);
		} else {
			$this->search["check_in"]   = (empty($request->search_check_in))   ? NULL : date("Y-m-d H:1:s", strtotime($request->search_check_in));
		}

		if($request->co) {
			$this->search["check_out"]  = date("Y-m-d H:1:s", $request->co);
		} else {
			$this->search["check_out"]  = (empty($request->search_check_out))  ? NULL : date("Y-m-d H:1:s", strtotime($request->search_check_out));
		}
	}


}  //End of Class
