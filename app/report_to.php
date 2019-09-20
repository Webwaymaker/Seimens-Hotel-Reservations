<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report_to extends Model {

//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	//Get Access Toekn Attribute ------------------------------------------------
	public function getAccessTokenAttribute() {
		return \App\Logic\access_token::makeToken($this->created_at);
	} 


} //End of Class
