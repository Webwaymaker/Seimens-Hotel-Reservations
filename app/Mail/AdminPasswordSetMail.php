<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminPasswordSetMail extends Mailable {
	 
	use Queueable, SerializesModels;

	public $admin;

	public function __construct($admin) {
		$this->admin = $admin;
	}

	public function build() {
		return $this->from("dev@webwaymaker.com")
						->subject("Siemens - Welcome Administrator")
						->view("emails.admin_password_set_mail");
	}

}  //End of class
