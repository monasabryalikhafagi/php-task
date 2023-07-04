<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends Migration {

	public function up()
	{
		Schema::create('departments', function(Blueprint $table) {
			$table->id('id');
			$table->string('name')->unique();
			$table->text('name')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('departments');
	}
}