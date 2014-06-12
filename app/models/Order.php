<?php

class Order extends Eloquent
{
	/**
	 * Relationship to the model User
	 *
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Relationship to the model Dish
	 *
	 * @return mixed
	 */
	public function dish()
	{
		return $this->belongsTo('Dish');
	}

	/**
	 * Relationship to the model Delivery
	 *
	 * @return mixed
	 */
	public function delivery()
	{
		return $this->belongsTo('Delivery');
	}
}