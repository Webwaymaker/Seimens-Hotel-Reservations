<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller {

//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('admin');
	}




}
