<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdvenrelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prodvenrelations',function($table){
			$table->increments('id');
			$table->string('vendor_id');
			$table->string('product_id');
			$table->string('description')->nullable();
			$table->string('regular_price');
			$table->string('delux_price');
			$table->string('premium_price');
			$table->string('city')->nullable();
			$table->timestamps();
		});
		
		Schema::table('products', function($table){
			$table->string('ovid',455)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prodvenrelations');
		
		Schema::table('products', function($table){
			$table->dropColumn('ovid');
		});
	}

}
