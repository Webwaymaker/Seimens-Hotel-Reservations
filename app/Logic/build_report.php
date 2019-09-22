<?php

namespace App\Logic;

class Build_report {

//------------------------------------------------------------------------------
// Properties
//------------------------------------------------------------------------------

	protected $registration_query_arr;


//------------------------------------------------------------------------------
// Constructor
//------------------------------------------------------------------------------

	public function __construct($registration_query_arr) {
		$this->registration_query_arr = $registration_query_arr;
	}


//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------

	// Make Toekn ---------------------------------------------------------------
	public function nightly() {
		$header = "Siemens Traning Registration Report for " . date("m/d/Y") . "\n\n";
		return $this->buildReport($header);
	}

	// Validate Token -----------------------------------------------------------
	public function custom() {
		$header = "Custom Siemens Traning Registration Report - requested on " . date("m/d/Y") . "\n\n";
		return $this->buildReport($header);
	}


//------------------------------------------------------------------------------
// Private Methods
//------------------------------------------------------------------------------

	// Build Report -------------------------------------------------------------
	private function buildReport($header) {

		//Build Report
		$columns = [
			'confirmation_num' => 'Confirmation Number',
			'first_name'       => 'First Name',
			'last_name'        => 'Last Name',       
			'email'            => 'Email Address', 
			'mobile_num'       => 'Mobile Number',
			'location'         => 'Location',
			'course_num'       => 'Course',
			'check_in_date'    => 'Check In Date',
			'check_out_date'   => 'Check Out Date',
			'handicapped'      => 'Handicapped',
			'special_req'      => 'Special Requests',
		];

		$temp_file = tmpFile();
		fputs($temp_file, $header);
		fputcsv($temp_file, $columns);
		if(empty($this->registration_query_arr)) {
			fputs($temp_file, "\n No new registrations were found");
		} else {
			foreach($this->registration_query_arr as $registration) {
				$row = [];
				foreach($columns as $db_col_name => $junk) {
					$row[] = $registration[$db_col_name];
				}
				fputcsv($temp_file, $row);
			}
		}

		$csv_path = stream_get_meta_data($temp_file)['uri'];
		$csv_file = file_get_contents($csv_path);

		fclose($temp_file);

		return $csv_file;
	}


}  //End of class