<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_to extends Model {

//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	//Get Access Toekn Attribute ------------------------------------------------
	public function getAccessTokenAttribute() {
		return \App\Logic\Access_token::makeToken($this->created_at);
	} 


} //End of Class
