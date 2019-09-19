<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report_to extends Model {

//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	public function getAccessTokenAttribute() {
		return strtotime($this->created_at);
	} 


} //End of Class
