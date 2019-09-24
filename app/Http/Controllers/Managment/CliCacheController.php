<?php

namespace App\Http\Controllers\Managment;

use Illuminate\Support\Facades\Artisan;

class CliCacheController {

//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------

	//Clear Cache All -----------------------------------------------------------
	public function ClearCacheAll() {
		$this->clearCache();
		$this->clearConfigCache();
	}

	// Clear Cache --------------------------------------------------------------
	public function clearCache() {
		if($this->authorizedUser()) {
			$exit_code = Artisan::call('cache:clear');
			echo date("Y-m-d H:i:s") . " - The <strong>Cache</strong> has been cleared <br />"; 
		}
	}

	// Clear Config Cache -------------------------------------------------------
	public function clearConfigCache() {
		if($this->authorizedUser()) {
			$exit_code = Artisan::call('config:cache');
			echo date("Y-m-d H:i:s") . " - The <strong>Config Cache</strong> has been cleared <br />"; 
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