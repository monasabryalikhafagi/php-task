<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration {

	public function up()
	{
		Schema::create('departments', function(Blueprint $table) {
			$table->id('id');
			$table->string('name');
			$table->string('slug')->unique();
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('departments');
	}
}