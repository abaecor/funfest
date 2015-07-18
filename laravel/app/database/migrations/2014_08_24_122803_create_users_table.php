<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('firstname',100)->nullable();
			$table->string('lastname',100)->nullable();
			$table->string('username',40);
			$table->string('password',100);
			$table->string('address',455)->nullable();
			$table->string('email',255)->nullable();
			$table->string('phone',255)->nullable();
			$table->boolean('isVendor')->default(0);
			$table->boolean('isSuper')->default(0);
			$table->enum('status',array('inactive','active'));
			$table->timestamps();
			$table->rememberToken();
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
