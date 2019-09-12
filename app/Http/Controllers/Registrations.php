<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;

class Registrations extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('registration');
	}

	// Show ---------------------------------------------------------------------
	public function show($con_num, $id) {
		dd($con_num);
		dd($id);
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'first_name'     => 'required|max:25',
			'last_name'      => 'required|max:25',
			'email'          => 'required|email|max:255',
			'mobile_num'     => 'required|alpha_num|max:20',
			'branch'         => 'required|max:50',
			'course_num'     => 'required|alpha_num|max:25',
			'check_in_date'  => 'required|date',
			'check_out_date' => 'required|date|after_or_equal:check_in_date',
			'handicapped'    => 'nullable|integer',
			'special_req'    => 'nullable|max:1000',
		]);

		$registration = new Registration;
		$registration->confirmation_num = uniqid() . rand(100, 999);
		$registration->first_name       = $request->first_name;
		$registration->last_name        = $request->last_name;
		$registration->email            = $request->email;
		$registration->mobile_num       = $request->mobile_num;
		$registration->course_num       = $request->course_num;
		$registration->branch           = $request->branch;
		$registration->check_in_date    = date('Y-m-d H:i:s', strtotime($request->check_in_date));
		$registration->check_out_date   = date('Y-m-d H:i:s', strtotime($request->check_out_date));
		$registration->special_req      = $request->special_req;
		$registration->handicapped      = ($request->handicapped) ? 1 : 0;
		$registration->save();
		
		return view('confirmation', ['confirmation_num' => $registration->confirmation_num]);
	}

}
