<?php

class Store extends Eloquent
{
	/**
	 * Relationship to the model Dish
	 *
	 * @return mixed
	 */
	public function dishes()
	{
		return $this->hasMany('Dish');
	}

	/**
	 * Relationship to the model Delivery
	 *
	 * @return mixed
	 */
	public function deliveries()
	{
		return $this->hasMany('Delivery');
	}
}