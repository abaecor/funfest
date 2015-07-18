<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('outlets', function($table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('address1');
			$table->string('address2');
			$table->string('city');
			$table->string('pincode');
			$table->string('phone');
			$table->string('delivery_options')->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('outlets');
	}

}
