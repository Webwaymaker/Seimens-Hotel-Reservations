<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	use Notifiable;

//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];


//------------------------------------------------------------------------------
// Accessors
//------------------------------------------------------------------------------

	//Get Access Toekn Attribute ------------------------------------------------
	public function getAccessTokenAttribute() {
		return \App\Logic\Access_token::makeToken($this->created_at);
	} 

	//Get Protect Admin Delete Attribute --------------------------------
	public function getProtectAdminDeleteAttribute() {
		if($this->id == \Auth::user()->id) return TRUE;
		return $this->ProtectedAdmin($this->id);
	} 

	//Get Protect Admin Reset Password Attribute --------------------------------
	public function getProtectAdminResetPasswordAttribute() {
		if($this->id == \Auth::user()->id) return FALSE;
		return $this->ProtectedAdmin($this->id);
	} 


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Protected Admin ----------------------------------------------------------
	private function ProtectedAdmin($id) {
		$protected_admins = [
			1,  //Kevin Bell's user_id
			2,  //Chris Peterson's user_id
		];

		return in_array($id, $protected_admins);
	}


} //End of Class
