<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateBlackoutsTable extends Migration {
	
	// Up -----------------------------------------------------------------------
	public function up() {
		Schema::create('date_blackouts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamp('active_date');
			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->text('description');
			$table->timestamps();
		});
	}

	// Down ---------------------------------------------------------------------
   public function down() {
		Schema::dropIfExists('date_blackouts');
	}
}

