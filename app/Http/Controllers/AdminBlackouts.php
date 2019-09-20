<?php

namespace App\Http\Controllers;

use App\Blackout_date;
use App\Registration;
use Illuminate\Http\Request;

class AdminBlackouts extends Controller {
//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Destroy ------------------------------------------------------------------
	public function destroy($token, $id) {
		$blackout = Blackout_date::where('id', $id)->get();
		if(empty($blackout[0])) return redirect(404);

		$valid_token = \App\Logic\Access_token::validateToken($blackout[0]->created_at, $token);
		if($valid_token == FALSE) return redirect(404);

		Blackout_date::destroy($id);

		return back()->with('status', 'The Blackout Date has been deleted.');
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'start_date'    => 'required|date|',
			'end_date'      => 'required|date|after_or_equal:start_date|after_or_equal:current_date',
			'activate_date' => 'required|date|before_or_equal:start_date',
			'description'   => 'required|max:191',
		]);

		//Format Dates for save and conflict check
		$start_date    = date("Y-m-d H:i:s", strtotime($request->start_date));
		$end_date      = date("Y-m-d H:i:s", strtotime($request->end_date));
		$activate_date = date("Y-m-d H:i:s", strtotime($request->activate_date));

		$blackout = new Blackout_date;
		$blackout->start_at    = $start_date;
		$blackout->end_at      = $end_date;
		$blackout->activate_at = $activate_date;
		$blackout->description = $request->description;
		$blackout->save();

		//Check for registration between blackout dates
		$conflicts = Registration::whereBetween("check_in_date", [$start_date, $end_date])
					 				    ->orWhereBetween("check_out_date", [$start_date, $end_date])
										 ->get();

		//Flash in conflicts if they exist
		if(!empty($conflicts[0])) {
			session()->flash("conflicts", $conflicts);
		}

		return back()->with('status', "The Blackout Date has been added.");
	}

} //End of class