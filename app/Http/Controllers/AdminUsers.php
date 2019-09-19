<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\AdminPasswordResetMail;
use App\Mail\AdminPasswordSetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AdminUsers extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Destroy ------------------------------------------------------------------
	public function destroy($token, $id) {
		$admin = User::where('id', $id)
						 ->where('created_at', date("Y-m-d H:i:s", $token))
						 ->get();

		if(empty($admin[0])) {
			return redirect(404);
		}

		User::destroy($id);

		return back()->with('status', 'The Admin ' . $admin[0]->name . ' has been deleted.');;
	}


	// Update (Reset Admin Password) --------------------------------------------
	public function update($token, $id) {
		$admin = User::where('id', $id)
						 ->where('created_at', date("Y-m-d H:i:s", $token))
						 ->get();

		if(empty($admin[0])) {
			return redirect(404);
		}

		$admin = $admin[0];
		
		Mail::to($admin->email)->send(new AdminPasswordResetMail($admin));

		return back()->with('status', 'A password reset request has been sent to ' . $admin->email );
	}

	// Store----------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'admin_name'  => 'required|max:191',
			'admin_email' => 'required|email|unique:users,email|max:191',
		]);

		$admin = new User;
		$admin->name  = $request->admin_name;
		$admin->email = $request->admin_email;
		$admin->password = bcrypt('welcome');
		$admin->save();

		Mail::to($admin->email)->send(new AdminPasswordSetMail($admin));

		return back()->with('status', $admin->name . ' has been added as a new Administrator.');
	}

}  //End of Class
