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
		$schedule->command('command:RunRegistrationReport')->everyMinute();
	}

	// Commands -----------------------------------------------------------------
	protected function commands() {
		$this->load(__DIR__.'/Commands');
		require base_path('routes/console.php');
	}


} //End of class
