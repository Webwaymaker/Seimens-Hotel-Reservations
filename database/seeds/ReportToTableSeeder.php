<?php

use Illuminate\Database\Seeder;

class ReportToTableSeeder extends Seeder {
	
	// Run ----------------------------------------------------------------------
	public function run() {
		$report_to_addresses = [
			'reports@webwaymaker.com',
			'chris@corpcoach.net',
			'dangoel@himountprospect.com',
			'hema.santhanakrishnan@siemens.com',
			'jcolon@himountprospect.com'
		];

		foreach($report_to_addresses as $report_to_address) {
			DB::table('report_tos')->insert([
            'email'      => $report_to_address,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);			
		}
		
	}

} //End of Class
