<?php

namespace App\Http\Controllers;

use App\Mail\ForgotConfMail;
use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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

		//Validate email, send  forgot email and redirect to edit page if valid 
		if($reg_conf_arr = $this->ValidEmail($request)) {
			Mail::to($request->email)->send(new ForgotConfMail($reg_conf_arr));
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
		$reg_conf_arr = Registration::where('email', $request->email)
							->where('canceled_at', NULL)
							->orderBy('created_at', 'desc')
				 			->get()
				 			->toArray();

		if(!empty($reg_conf_arr)) return $reg_conf_arr;
		
		return false;
	}

}
