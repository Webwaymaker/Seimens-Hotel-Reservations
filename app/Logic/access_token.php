<?php

namespace App\Logic;

class Access_token {

	// Make Toekn ---------------------------------------------------------------
	public static function makeToken($date_time) {
		return md5(strtotime($date_time));
	}

	// Validate Token -----------------------------------------------------------
	public static function validateToken($date_time, $token) {
		return (md5(strtotime($date_time)) == $token) ? TRUE : FALSE;
	}


}  //End of class