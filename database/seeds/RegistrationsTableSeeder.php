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
					'updated_at'       => ($data[15] == "0000-00-00 00:00:00") ? $data[14] : $data[15],
					'reported_at'      => ($data[16] == "0000-00-00 00:00:00") ? NULL : $data[16],
					'canceled_at'      => ($data[17] == "0000-00-00 00:00:00") ? NULL : $data[17],
				]);			
			
				db::table('registrations')
				  ->where("reported_at", NULL)
				  ->whereDate("created_at", "<", "2019-07-26 00:00:00")
				  ->update(['reported_at' => '2019-09-22 00:00:00']);


				//if($cntr++ > 1000) break;
			}

			fclose($fp);
		}
	}

}	//End of class
