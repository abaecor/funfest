<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCakeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cakes',function($table){
			$table->increments('id');
			$table->string('type',100);
			$table->string('product_code',100);
			$table->string('vendor_id',455);
			$table->string('title',100);
			$table->string('description',455);
			$table->string('image',455);
			$table->decimal('price',7,2);
			$table->string('city',1055)->nullable();
			$table->string('tags',255)->nullable();
			$table->boolean('availability')->default(1);
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
		Schema::drop('cakes');
	}

}
