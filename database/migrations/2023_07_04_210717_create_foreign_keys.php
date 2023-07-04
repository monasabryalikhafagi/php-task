<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('manger_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('department_id')->references('id')->on('departments')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tasks', function(Blueprint $table) {
			$table->foreign('employee_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tasks', function(Blueprint $table) {
			$table->foreign('manger_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_manger_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_department_id_foreign');
		});
		Schema::table('tasks', function(Blueprint $table) {
			$table->dropForeign('tasks_employee_id_foreign');
		});
		Schema::table('tasks', function(Blueprint $table) {
			$table->dropForeign('tasks_manger_id_foreign');
		});
	}
}