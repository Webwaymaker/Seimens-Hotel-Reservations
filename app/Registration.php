<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registration extends Model {

//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	protected $guarded = [];


//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	// Get Check In Date Attribue -----------------------------------------------
	public function getCheckInDateAttribute($value) {
		return date("m/d/Y", strtotime($value));
	}

	// Get Check In Out Attribue -----------------------------------------------
	public function getCheckOutDateAttribute($value) {
		return date("m/d/Y", strtotime($value));
	}

} //End of Class
