<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;

class EditLogin extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('edit_login');
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'email'            => 'required|email|max:255',
			'confirmation_num' => 'required|alpha_num|max:20',
		]);

		if($reg_id = $this->ValidLogin($request)) {
			return redirect("/registration/" . $request->confirmation_num . "/" . $reg_id . "/edit");
		} 

		return view('edit_login', ['invalid' => TRUE]);
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

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


}
