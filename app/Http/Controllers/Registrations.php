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
	public function show($conf_num, $id) {
		$reg_data = $this->GetRegistrationData($conf_num, $id);
		return view('registration_update', compact('reg_data', 'conf_num', 'id'));
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate($this->GetFieldValidationArr());

		$registration = new Registration;
		$this->SaveRegistrationData($registration, $request);

		return view('registration_success', compact('registration'));
	}

	// Update -------------------------------------------------------------------
	public function Update(Request $request, $conf_num, $id) {
		$valid = $request->validate($this->GetFieldValidationArr());

		$registration = $this->GetRegistrationData($conf_num, $id);
		if(!empty($registration)) {
			$this->SaveRegistrationData($registration, $request, TRUE);
		} else {
			return view('registration_update_error');
		}

		return view('registration_update_success', compact('registration'));
	}

	// Destroy ------------------------------------------------------------------
	public function destroy($conf_num, $id) {
		$registration = $this->GetRegistrationData($conf_num, $id);
		
		if(!empty($registration)) {
			$registration->canceled_at = date("Y-m-d H:i:s");
			$registration->save();
		} else {
			return view('registration_cancel_error');
		}

		return view('registration_cancel_success', compact("registration"));
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Get Field Validation Array  ----------------------------------------------
	private function GetFieldValidationArr() {
		return [
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
		];
	}

	// Get Registration Data ----------------------------------------------------
	private function GetRegistrationData($conf_num, $id) {
		$reg_data = Registration::where("id", $id)
						-> where('confirmation_num', $conf_num)
						-> where('canceled_at', NULL)
						-> limit(1)
						-> get();

		if(!empty($reg_data[0])) return $reg_data[0];

		return false;
	}

	// Save Registration Data ---------------------------------------------------
	private function SaveRegistrationData($registration, $request, $edit_record = FALSE) {
		//Only add a Confirmation number if it is a new record
		if($edit_record == FALSE) {
			$registration->confirmation_num = uniqid() . rand(100, 999);
		}

		//Base data for add and Edit
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
	}

} //End Of Class
