<?php

use Illuminate\Database\Seeder;

class RegistrationsTableSeeder extends Seeder {

	// Run ----------------------------------------------------------------------
	public function run() {
		set_time_limit(0);

		$cntr = 0;
		if (($fp = fopen("database/seeds/reigistrations_seed_base.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($fp)) !== FALSE) {
				DB::table('registrations')->insert([
					'confirmation_num' => substr($data[1], 0, 20),
					'first_name'       => substr($data[3], 0, 25),
					'last_name'        => substr($data[4], 0, 25),
					'email'            => substr($data[5], 0, 191),
					'mobile_num'       => (empty($data[6])) ? "000-000-0000" : substr($data[6], 0, 20),
					'location'         => substr($data[8], 0, 50),
					'course_num'       => substr($data[7], 0, 25),
					'check_in_date'    => $data[9],
					'check_out_date'   => $data[10],
					'special_req'      => $data[12],
					'handicapped'      => $data[11],
					'created_at'       => $data[14],
					'updated_at'       => $data[14],
				]);			
			
				if($cntr++ > 1000) break;
			}

			fclose($fp);
		}
	}

}	//End of class
