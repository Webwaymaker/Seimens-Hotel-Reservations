<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationReportMail extends Mailable {
	 
	use Queueable, SerializesModels;

//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	public $registrations;
	public $base_url;
	public $custom;


//------------------------------------------------------------------------------
// Constructor
//------------------------------------------------------------------------------

	public function __construct($registrations, $custom = FALSE) {
		$this->registrations = $registrations;
		$this->base_url      = \URL::to('/');
		$this->custom        = $custom;
	}


//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------

	public function build() {
		$report_builder = new \App\Logic\Build_report($this->registrations);
		$csv_file       = ($this->custom) ? $report_builder->custom() : $report_builder->nightly();
		$subject        = "Siemens Training Registration Report for " . date("m/d/Y");
		$subject        = ($this->custom) ? "Custom " . $subject : $subject;
 
		return $this->from("dev@webwaymaker.com")
						->subject($subject)
						->view("emails.registration_report_mail")
						->attachData($csv_file, $subject . ".csv");
	}


}  //End of class
