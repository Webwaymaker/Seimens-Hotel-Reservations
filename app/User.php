<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable {

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
		return \App\Logic\access_token::makeToken($this->created_at);
	} 

	
} //End of Class
