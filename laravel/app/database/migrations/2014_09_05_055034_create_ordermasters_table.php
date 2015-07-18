<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdermastersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordermasters',function($table){
			$table->increments('id');
			$table->string('order_id',255);
			$table->string('transaction_id',255);
			$table->string('bank_transaction_id',255)->nullable();
			$table->enum('payment_method',array('paypal','bank','others'));
			$table->string('name',255);
			$table->string('contact',13);
			$table->string('billing_address',1000);
			$table->string('billing_city',255);
			$table->string('billing_zip',255);
			$table->string('billing_state',255);
			$table->string('billing_country',255);
			$table->string('bill_value',255);
			$table->string('transaction_message',455)->nullable();
			$table->enum('status',array('error','cleared','uncleared'));
			$table->enum('process',array('initiate','new'));
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
		Schema::drop('ordermasters');
	}

}
