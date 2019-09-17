<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackoutDatesTable extends Migration {
	
	// Up -----------------------------------------------------------------------
	public function up() {
		Schema::create('blackout_dates', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamp('active_at')->nullable();
			$table->timestamp('start_at')->nullable();
			$table->timestamp('end_at')->nullable();
			$table->text('description');
			$table->timestamps();
		});
	}

	// Down ---------------------------------------------------------------------
   public function down() {
		Schema::dropIfExists('blackout_dates');
	}
}

