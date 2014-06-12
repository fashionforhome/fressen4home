<?php

class Delivery extends Eloquent
{
	protected $table = 'deliveries';

	/**
	 * Relationship to the model Store
	 *
	 * @return mixed
	 */
	public function store()
	{
		return $this->belongsTo('Store');
	}

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
	 * Relationship to the model Order
	 *
	 * @return mixed
	 */
	public function orders()
	{
		return $this->hasMany('Order');
	}
}