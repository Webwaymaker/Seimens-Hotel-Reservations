<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\AdminPasswordSetMail;
use Illuminate\Http\Request;

class AdminPasswords extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// show ---------------------------------------------------------------------
	// Show reset password
	public function show($time, $token, $id) {
		$admin = User::where('id', $id)->get();
		if(empty($admin[0])) return redirect(404);

		$valid_token = \App\Logic\Access_token::validateToken($admin[0]->created_at, $token);
		if($valid_token == FALSE) return redirect(404);

		//Check If Expiered (User has 48 hours to respond)
		$expire_stamp = $time + (3600 * 48);
		if($expire_stamp < time()) {
			return redirect(410);  //410 = HTTP Response "Gone" -> https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/410
		}

		$admin = $admin[0];

		return view("admin.reset_password", compact('admin'));
	}

	// Index --------------------------------------------------------------------
	// Show Set Initial Password  
	public function index($token,  $id) {
		$admin = User::where('id' , $id)->get();
		if(empty($admin[0])) return redirect(404);

		$valid_token = \App\Logic\Access_token::validateToken($admin[0]->created_at, $token);
		if($valid_token == FALSE) return redirect(404);
		
		$admin = $admin[0];
		return view("admin.set_password", compact('admin'));
	}

	// Update -------------------------------------------------------------------
	public function update(Request $request) {
		$valid = $request->validate([
			'new_password'  => 'required|min:10|max:20',
			'conf_password' => 'same:new_password',
		]);

		$admin = User::where('id', $request->id)->get();
		if(empty($admin[0])) return redirect(404);

		$valid_token = \App\Logic\Access_token::validateToken($admin[0]->created_at, $request->access_token);
		if($valid_token == FALSE) return redirect(404);

		$admin = $admin[0];
		$admin->password = bcrypt($request->new_password);
		$admin->save();

		return redirect("login");
	}

}  //End of Class