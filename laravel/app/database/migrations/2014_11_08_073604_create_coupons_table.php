<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('coupons', function($table){
			$table->date('expiry');
			$table->string('type',255);
			$table->string('status',50);
			$table->string('parent_id',255)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('coupons', function($table){
		    $table->dropColumn('expiry');
		    $table->dropColumn('type');
			$table->dropColumn('status');
			$table->dropColumn('parent_id');
		});
	}

}
