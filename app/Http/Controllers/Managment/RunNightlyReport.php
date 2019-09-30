<?php

namespace App\Http\Controllers\Managment;

use Illuminate\Support\Facades\Artisan;

class RunNightlyReport {

//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------

	// Run -------------- -------------------------------------------------------
	public function run() {
		if($this->authorizedUser()) {
			$exit_code = Artisan::call('command:RunRegistrationReport');
			echo date("Y-m-d H:i:s") . " - The Nightly Registration Report has 
			   completed and been sent to all Report-Tos <br />"; 
		}
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Authorized User ---------------------------------------------------------
	private function authorizedUser() {
		$authorized_users = [
			"kevinbell",
		];

		$current_auth_user_name = strtolower(str_replace(" ", "", \Auth::user()->name));
		$valid_user = in_array($current_auth_user_name, $authorized_users);

		return $valid_user;
	}


}  //End of class