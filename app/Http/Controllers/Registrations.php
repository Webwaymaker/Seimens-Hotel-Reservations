<?php

namespace App\Http\Controllers;

use App\Blackout_date;
use App\Registration;
use App\Mail\RegistrationConfMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Registrations extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		$blackout_dates = $this->GetBlackoutDates();
		return view('registrations.registration', compact(["blackout_dates"]));
	}

	// Show ---------------------------------------------------------------------
	public function show($conf_num, $id) {
		$reg_data       = $this->GetRegistrationData($conf_num, $id);
		$blackout_dates = $this->GetBlackoutDates();
		return view('registrations.registration_update', compact('reg_data', 'blackout_dates', 'conf_num', 'id'));
	}

	// Show Admin ---------------------------------------------------------------
	public function showAdmin($conf_num, $id) {
		$reg_data       = $this->GetRegistrationData($conf_num, $id);
		$blackout_dates = $this->GetBlackoutDates();
		return view('registrations.registration_update_admin', compact('reg_data', 'blackout_dates', 'conf_num', 'id'));
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate($this->GetFieldValidationArr());

		$registration = new Registration;
		$this->SaveRegistrationData($registration, $request);

		Mail::to($registration->email)->send(new RegistrationConfMail($registration));

		return view('registrations.success', compact('registration'));
	}

	// Update -------------------------------------------------------------------
	public function Update(Request $request, $conf_num, $id) {
		$valid = $request->validate($this->GetFieldValidationArr());

		$registration = $this->GetRegistrationData($conf_num, $id);
		if(!empty($registration)) {
			$this->SaveRegistrationData($registration, $request, TRUE);
		} else {
			return view('registrations.update_error');
		}

		return view('registrations.update_success', compact('registration'));
	}

	// Destroy ------------------------------------------------------------------
	public function destroy($conf_num, $id) {
		$registration = $this->GetRegistrationData($conf_num, $id);
		
		if(!empty($registration)) {
			$registration->canceled_at = date("Y-m-d H:i:s");
			$registration->save();
		} else {
			return view('registrations.cancel_error');
		}

		return view('registrations.cancel_success', compact("registration"));
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Get Blackout Dates -------------------------------------------------------
	private function GetBlackoutDates() {
		$current_date = date("Y-m-d H:i:s");
		$blackouts    = Blackout_date::where('active_at', '<', $current_date)
											  ->where('end_at', '>', $current_date)
											  ->orderBy('start_at', 'asc')
										     ->get();
		return $blackouts;
	}

	// Get Field Validation Array  ----------------------------------------------
	private function GetFieldValidationArr() {
		return [
			'first_name'     => 'required|max:25',
			'last_name'      => 'required|max:25',
			'email'          => 'required|email|max:255',
			'mobile_num'     => 'required|max:20',
			'location'       => 'required|max:50',
			'course_num'     => 'required|max:25',
			'handicapped'    => 'nullable|integer',
			'special_req'    => 'nullable|max:3000',
			'check_in_date'  => [
				'required',
				'date',
				function($attribute, $value, $fail) {
					$check_in = date("Y-m-d H:i:s", strtotime($value));
					$blackout = Blackout_date::where("start_at", "<=", $check_in)
													 ->where("end_at",   ">=", $check_in)
													 ->get();
					if(!empty($blackout[0])) {
						$fail("This Ckeck In Date falls within one of the Reserved date ranges.");
					}
				}
			],
			'check_out_date' => [
				'required',
				'date',
				'after_or_equal:check_in_date',
				function($attribute, $value, $fail) {
					$check_out = date("Y-m-d H:i:s", strtotime($value));
					$blackout  = Blackout_date::where("start_at", "<=", $check_out)
													  ->where("end_at",   ">=", $check_out)
													  ->get();
					if(!empty($blackout[0])) {
						$fail("This Ckeck Out Date falls within one of the Reserved date ranges.");
					}
				}
			],
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
		$registration->location         = $request->location;
		$registration->check_in_date    = date('Y-m-d H:i:s', strtotime($request->check_in_date));
		$registration->check_out_date   = date('Y-m-d H:i:s', strtotime($request->check_out_date));
		$registration->special_req      = $request->special_req;
		$registration->handicapped      = ($request->handicapped) ? 1 : 0;
		
		$registration->save();
	}


	// Send Registration Email --------------------------------------------------
	public function SendRegistrationEmail(Request $request) {
		Mail::to($request->email)->send(new RegistrationConfMail($request));
	}


} //End Of Class
