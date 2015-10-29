<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Database
 * @subpackage Migrations
 *
 * @author Kolja Zuelsdorf <kolja.zuelsdorf@fashion4home.de>
 *
 * @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 11.06.2014
 * Time: 22:04
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLayout extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			/** @var Blueprint $table */
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});

		Schema::create('stores', function($table)
		{
			/** @var Blueprint $table */
			$table->increments('id');
			$table->string('name');
			$table->string('phone_number');
			$table->string('street');
			$table->string('postcode');
			$table->string('city');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});

		Schema::create('dishes', function($table)
		{
			/** @var Blueprint $table */
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->string('store_dish_id');
			$table->string('name');
			$table->integer('price');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->foreign('store_id')->references('id')->on('stores');
		});

		Schema::create('deliveries', function($table)
		{
			/** @var Blueprint $table */
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->dateTime('closing_time');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->foreign('store_id')->references('id')->on('stores');
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::create('orders', function($table)
		{
			/** @var Blueprint $table */
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('dish_id')->unsigned();
			$table->integer('delivery_id')->unsigned();
			$table->integer('paid');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('dish_id')->references('id')->on('dishes');
			$table->foreign('delivery_id')->references('id')->on('deliveries');
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
		Schema::drop('deliveries');
		Schema::drop('dishes');
		Schema::drop('stores');
		Schema::drop('users');
	}

}
