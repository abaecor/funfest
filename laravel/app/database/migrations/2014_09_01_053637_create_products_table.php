<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products',function($table){
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories');
			$table->integer('vendor_id')->unsigned();
			$table->foreign('vendor_id')->references('id')->on('users');
			$table->string('title',100);
			$table->string('description',455);
			$table->string('image',455);
			$table->decimal('regular_price',7,2);
			$table->decimal('delux_price',7,2);
			$table->decimal('premium_price',7,2);
			$table->string('city',255)->nullable();
			$table->string('tags',255)->nullable();
			$table->float('weight')->nullable();
			$table->integer('views')->nullable();
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
		Schema::drop('products');
	}

}
