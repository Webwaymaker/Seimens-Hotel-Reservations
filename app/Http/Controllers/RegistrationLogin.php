<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;

class RegistrationLogin extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('registration_login');
	}

	// Login --------------------------------------------------------------------
	public function login(Request $request) {
		$valid = $request->validate([
			'email'            => 'required|email|max:255',
			'confirmation_num' => 'required|alpha_num|max:20',
		]);

		//Validate credentials and redirect to edit page if valid
		if($reg_id = $this->ValidLogin($request)) {
			return redirect("/registration/" . $request->confirmation_num . "/" . $reg_id . "/edit");
		} 

		//Return to page and show errors
		$return_data = [
			'invalid'          => TRUE,
			'email'            => $request->email,
			'confirmation_num' => $request->confirmation_num,
		];

		return view('registration_login', $return_data);
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Valid Login --------------------------------------------------------------
	private function ValidLogin($request) {
		$reg_data = Registration::select("id")
					 ->where('email', $request->email)
					 ->where('confirmation_num', $request->confirmation_num)
					 ->limit(1)
					 ->get();


		if(!empty($reg_data[0]['id'])) {
			return $reg_data[0]['id'];
		}

		return false;
	}

} //End of class
