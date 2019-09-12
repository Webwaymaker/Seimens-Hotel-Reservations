<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;

class ForgotConfNum extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('forgot_conf_num');
	}

	// Check Email --------------------------------------------------------------
	public function CheckEmail(Request $request) {
		$valid = $request->validate([
			'email' => 'required|email|max:255',
		]);

		//Validate email and redirect to edit page if valid
		if($conf_num_arr = $this->ValidEmail($request)) {
//TODO: We need to send email here
			return view("forgot_conf_num_success", ["email" => $request->email]);
		} 

		//Return to page and show errors
		$return_data = [
			'invalid' => TRUE,
			'email'   => $request->email,
		];

		return view('forgot_conf_num', $return_data);
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Valid Email --------------------------------------------------------------
	private function ValidEmail($request) {
		$reg_data = Registration::select("confirmation_num")
					 ->where('email', $request->email)
					 ->get()
					 ->toArray();

		if(!empty($reg_data)) {
			return $reg_data;
		}

		return false;
	}

}
