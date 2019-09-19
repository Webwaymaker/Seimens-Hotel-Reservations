<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminPasswordResetMail extends Mailable {
	 
	use Queueable, SerializesModels;

	public $admin;

	public function __construct($admin) {
		$this->admin = $admin;
	}

	public function build() {
		return $this->from("dev@webwaymaker.com")
						->subject("Siemens - Administrator Passsword Reset")
						->view("emails.admin_password_reset_mail");
	}

}  //End of class
