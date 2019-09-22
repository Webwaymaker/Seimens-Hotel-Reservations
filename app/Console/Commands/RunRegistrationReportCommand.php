<?php

namespace App\Console\Commands;

use App\Registration;
use App\Report_to;
use App\Mail\RegistrationReportMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RunRegistrationReportCommand extends Command {

//------------------------------------------------------------------------------
// Properties	
//------------------------------------------------------------------------------	

	protected $signature   = 'command:RunRegistrationReport';
	protected $description = 'This command runs the nightly registration report 
									  and sends it to all email addresses on the Report_Tos 
									  database  table';

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
$eamil_to = [
	"kevin@webwaymaker.com",
	"reports@webwaymaker.com",
];
	
//		$eamil_tos     = Report_to::pluck('email');
		$registrations = Registration::whereNull('reported_at')
											  ->whereNull('canceled_at')
											  ->orderBy('check_in_date', 'asc')
											  ->get()
											  ->toArray();
//dd($registrations);

		Mail::to($eamil_to)->send(new RegistrationReportMail($registrations));

//		$updated = Registration::whereNull('reported_at')->update(['reported_at' => Carbon::now()]);

		echo "Done Boss \n";
	}

} //End of class
