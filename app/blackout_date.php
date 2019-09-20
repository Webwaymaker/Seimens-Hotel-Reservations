<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blackout_date extends Model {

//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	// Get Access Toekn ---------------------------------------------------------
	public function getAccessTokenAttribute() {
		return \App\Logic\access_token::makeToken($this->created_at);
	} 

	// Get Activate At Date Attribue --------------------------------------------
	public function getActivateAtAttribute($value) {
		return date("m/d/Y", strtotime($value));
	}

	// Get Start At Attribue ----------------------------------------------------
	public function getStartAtAttribute($value) {
		return date("m/d/Y", strtotime($value));
	}

	// Get End At Attribue ------------------------------------------------------
	public function getEndAtAttribute($value) {
		return date("m/d/Y", strtotime($value));
	}

}  //End of class
