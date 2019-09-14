<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationConfMail extends Mailable {
	 
	use Queueable, SerializesModels;


	public $registration;


	public function __construct($registration) {
		$this->registration = $registration;
	}

	public function build() {
		return $this->from("dev@webwaymaker.com")
						->view('emails.registration_conf_mail');
	}

}  //End of class
