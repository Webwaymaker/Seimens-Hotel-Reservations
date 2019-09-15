<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration {

	// Up -----------------------------------------------------------------------
	public function up() {
		Schema::create('registrations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('confirmation_num', 20);
			$table->string('first_name', 25);
			$table->string('last_name', 25);
			$table->string('email', 255);
			$table->string('mobile_num', 20);
			$table->string('company_name', 50);
			$table->string('course_num', 25);
			$table->timestamp('check_in_date');
			$table->timestamp('check_out_date');
			$table->text('special_req')->nullable();
			$table->unsignedTinyInteger('handicapped')->default(0);
			$table->timestamps();
			$table->timestamp('reported_at')->nullable();
			$table->timestamp('canceled_at')->nullable();
		});
	}

	// Down ---------------------------------------------------------------------
	public function down() {
		Schema::dropIfExists('registrations');
	}

} //End of Class
