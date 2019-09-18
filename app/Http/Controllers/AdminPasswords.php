<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\AdminPasswordSetMail;
use Illuminate\Http\Request;

class AdminPasswords extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Show ---------------------------------------------------------------------
	public function show($conf_num,  $id) {
		//Get admin data from Conf_num and id
		$admin = User::where('id' , $id)
						 ->where('created_at', date("Y-m-d H:i:s", $conf_num))
						 ->get();

		//If the admin does not exist show 404
		if(empty($admin[0])) {
			return redirect(404);
		}
 
		$admin = $admin[0];
		return view("admin.set_password", compact('admin'));
	}

	// Update -------------------------------------------------------------------
	public function update(Request $request) {
		$valid = $request->validate([
			'new_password'  => 'required|min:10|max:20',
			'conf_password' => 'same:new_password',
		]);

		$admin = User::where('id', $request->id)
						 ->where('created_at', date('Y-m-d H:i:s', $request->conf_num))
						 ->get();

		if(empty($admin[0])) {
			return redirect(404);
		}

		$admin = $admin[0];
		$admin->password = bcrypt($request->new_password);
		$admin->save();

		return redirect("login");
	}

}  //End of Class