<?php

namespace App\Console\Commands;

use App\Registration;
use App\Report_to;
use App\Mail\RegistrationReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RunRegistrationReportCommand extends Command {

//------------------------------------------------------------------------------
// Properties	
//------------------------------------------------------------------------------	

	protected $signature   = 'command:RunRegistrationReport';
	protected $description = 'This command runs the nightly registration report 
									  and sends it to all email addresses on the Report_Tos 
									  database table.';

//------------------------------------------------------------------------------
// Constructor
//------------------------------------------------------------------------------	

	public function __construct() {
		parent::__construct();
	}


//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------	

	// Handle -------------------------------------------------------------------
	public function handle() {		
		//$eamil_tos     = Report_to::pluck('email');
$eamil_tos = ["kevin@webwaymaker.com", "accounts@webwaymaker.com"];  // For debugging		
		$registrations = Registration::whereNull('reported_at')
											  ->whereNull('canceled_at')
											  ->orderBy('check_in_date', 'asc')
											  ->get()
											  ->toArray();

		// Send Registration Report
		Mail::to($eamil_tos)->send(new RegistrationReportMail($registrations));

		// Set Report_at on databse table to current date for all registrations reported
		Registration::whereNull('reported_at')->update(['reported_at' => Carbon::now()]);

		//Build Cron Log entry and post
		$log_message  = "Cron: Nightly Report Run\n";
		
		$log_message .= " - Email To\n";
		foreach($eamil_tos as $email_to) {
			$log_message .= "   - $email_to\n";
		}
		
		$log_message .= " - Registrations\n";
		if(!empty($registrations)) {
			foreach($registrations as $registration) {
				$log_message .= "   - " . $registration["first_name"] . " " . $registration["last_name"] . "\n";
			}
		} else {
			$log_message .= "   - No new registrations\n";
		}
		
		$failures = Mail::failures();
		$log_message .= " - Mail Failures\n";
		if(!empty($failures)) {
			foreach($failures as $failure) {
				$log_message .= "   - $failure\n";
			}
		} else {
			$log_message .= "   - None :)\n";
		}
			
		$log_message .= "\n";
		
		Log::channel('cronlog')->info($log_message);
	}

} //End of class
