<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTosTable extends Migration {

	// Up -----------------------------------------------------------------------
	public function up() {
		Schema::create('report_tos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('email');
			$table->string('status')->default('active');
			$table->timestamps();
		});
	}

	// Down ---------------------------------------------------------------------
   public function down() {
		Schema::dropIfExists('report_tos');
	}
}
