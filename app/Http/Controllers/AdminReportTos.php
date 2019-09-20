<?php

namespace App\Http\Controllers;

use App\Report_to;
use Illuminate\Http\Request;

class AdminReportTos extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Destroy ------------------------------------------------------------------
	public function destroy($token, $id) {
		$report_to = Report_to::where('id', $id)->get();
		if(empty($report_to[0])) return redirect(404);

		$valid_token = \App\Logic\Access_token::validateToken($report_to[0]->created_at, $token);
		if($valid_token == FALSE) return redirect(404);

		Report_to::destroy($id);

		return back()->with('status', 'The reporting email address ' . $report_to[0]->email . ' has been deleted.');;
	}

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'report_to_email' => 'required|email|unique:report_tos,email|max:191',
		]);

		$report_to = new Report_to;
		$report_to->email = $request->report_to_email;
		$report_to->save();

		return back()->with('status', $report_to->email . ' has been added as a new Report-to.');
	}


}  //End of Class