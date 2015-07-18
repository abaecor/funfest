<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders',function($table){
			$table->increments('id');
			$table->string('order_id',255);
			$table->integer('product_id');
			$table->integer('add_on_id')->nullable();
			$table->integer('vendor_id');
			$table->enum('status',array('cancelled','delivered','dispatched','neworder'));
			$table->string('name',255);
			$table->string('contact',11);
			$table->string('shipping_address',1000);
			$table->string('shipping_city',255);
			$table->string('shipping_zip',255);
			$table->string('shipping_state',255);
			$table->string('shipping_country',255);
			$table->string('price',10);
			$table->string('quantity',3);
			$table->enum('payment_clearance',array('cleared','uncleared'));
			$table->enum('process',array('initiate','new','cancel'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
