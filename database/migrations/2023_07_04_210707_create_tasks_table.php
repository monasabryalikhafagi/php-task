<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {

	public function up()
	{
		Schema::create('tasks', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->text('description')->nullable();
			$table->bigInteger('employee_id')->unsigned()->nullable();
			$table->bigInteger('manger_id')->unsigned()->nullable();
			$table->tinyInteger('status')->nullable();
			$table->string('title');
		});
	}

	public function down()
	{
		Schema::drop('tasks');
	}
}