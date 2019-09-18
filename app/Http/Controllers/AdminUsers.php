<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\AdminPasswordSetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AdminUsers extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Store----------------------------------------------------------------
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

		// return view('registration_success', compact('registration'));
	}

}  //End of Class
