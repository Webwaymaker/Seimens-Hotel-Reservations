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
	public function index($display = "administrators") {

		switch($display) {
			case "registrations":
				$registrations = Registration::orderBy("check_in_date", "desc")->paginate(25);
				$view_data = compact("display", "registrations");       
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

}  //End of Class
