<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotConfMail extends Mailable {
	 
	use Queueable, SerializesModels;

	public $reg_conf_arr;

	public function __construct($reg_conf_arr) {
		$this->reg_conf_arr = $reg_conf_arr;
	}

	public function build() {
		return $this->from("dev@webwaymaker.com")
						->subject("Siemens - Registration Confirmation Numbers")
						->view("emails.forgot_conf_mail");
	}

}  //End of class
