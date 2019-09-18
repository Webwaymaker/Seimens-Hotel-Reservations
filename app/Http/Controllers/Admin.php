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
	public function index() {
		$users          = User::all();
		$report_tos     = Report_to::all();
		$blackout_dates = Blackout_date::all();
		$registrations  = Registration::all();

		return view('admin.admin', compact('users', 'report_tos', 'blackout_dates', 'registrations'));
	}

}  //End of Class
