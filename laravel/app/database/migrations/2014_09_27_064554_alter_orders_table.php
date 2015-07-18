<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	//ALTER TABLE `orders` CHANGE `vendor_id` `vendor_id` INT( 11 ) NULL;
	public function up()
	{
		Schema::table('orders', function($table){
			$table->string('user_id',5)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function($table){
			$table->dropColumn('user_id');
		});
	}

}
