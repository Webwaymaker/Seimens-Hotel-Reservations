<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model {

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

	// Get Handicapped Attribue -------------------------------------------------
	public function getHandicappedAttribute($value) {
		return ($value) ? "Yes" : "No";
	}

	// Get Handicapped Attribue -------------------------------------------------
	public function getSpecialReqAttribute($value) {
		return ($value) ? $value : "None";
	}

} //End of Class
