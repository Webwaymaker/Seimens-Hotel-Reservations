<?php

namespace App\Http\Controllers;

use App\Report_to;
use Illuminate\Http\Request;

class AdminReportTos extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Store --------------------------------------------------------------------
	public function store(Request $request) {
		$valid = $request->validate([
			'report_to_email' => 'required|email|unique:report_tos,email|max:191',
		]);

		$report_to = new Report_to;
		$report_to->email = $request->report_to_email;
		$report_to->save();
	}


}  //End of Class