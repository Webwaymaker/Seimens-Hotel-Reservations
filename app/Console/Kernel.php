<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	protected $commands = [];


//------------------------------------------------------------------------------
// Protected Functions
//------------------------------------------------------------------------------

	// Schedule -----------------------------------------------------------------
	protected function schedule(Schedule $schedule) {

		// This is not running correctly in production.  It will not send the 
		// Email.  I couod not find a solution to the scheduler problem so
		// I had to create a Cron Job that runs off of siemens.corpcoach.net/rnr
		// Route.  I am so ashamed!!!!!!
		$schedule->command('command:RunRegistrationReport')
					->timezone('America/Chicago')
					->at('01:00');
	}

	// Commands -----------------------------------------------------------------
	protected function commands() {
		$this->load(__DIR__.'/Commands');
		require base_path('routes/console.php');
	}


} //End of class
