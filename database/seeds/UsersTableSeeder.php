<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	
	// Run ----------------------------------------------------------------------
	public function run() {
		$base_user_data = [
			['name'  => 'Kevin Bell',            'email' => 'kevin@webwaymaker.com' ],
			['name'  => 'Chris Peterson',        'email' => 'chris@corpcoach.net' ],
			['name'  => 'Amy Spanske',           'email' => 'amy.spanske@siemens.com' ],
			['name'  => 'Cheryl Dobson',         'email' => 'cheryl.dobson@siemens.com' ],
			['name'  => 'J Colon',               'email' => 'jcolon@himountprospect.com' ],
			['name'  => 'Sarah Meyer',           'email' => 'sarah.meyer@siemens.com' ],
			['name'  => 'Horace Dunmore',        'email' => 'horace@corpcoach.net' ],
			['name'  => 'Hema Santhanakrishnan', 'email' => 'hema.santhanakrishnan@siemens.com' ],
			['name'  => 'George Kuhn',           'email' => 'george.kuhn@siemens.com' ],
			['name'  => 'Dan Goel',              'email' => 'dangoel@himountprospect.com' ],
		];

		foreach($base_user_data as $user_data) {
			DB::table('users')->insert([
            'name'       => $user_data['name'],
            'email'      => $user_data['email'],
            'password'   => bcrypt('welcome'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);			
		}
		
	}

} //End of Class

