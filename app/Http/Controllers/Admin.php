<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller {


//------------------------------------------------------------------------------
// Contructor
//------------------------------------------------------------------------------

	public function __construct() {
		$this->middleware('auth');
	}


//------------------------------------------------------------------------------
// Action Methods
//------------------------------------------------------------------------------

	// Index --------------------------------------------------------------------
	public function index() {
		return view('admin');
	}




}
