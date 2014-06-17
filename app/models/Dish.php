<?php

class Dish extends Eloquent
{

    protected $fillable = array('store_dish_id', 'name', 'price');

	protected $table = 'dishes';

	/**
	 * Relationship to the model Order
	 *
	 * @return mixed
	 */
	public function orders()
	{
		return $this->hasMany('Order');
	}

	/**
	 * Relationship to the model Store
	 *
	 * @return mixed
	 */
	public function store()
	{
		return $this->belongsTo('Store');
	}
}