<?php

class Delivery extends Eloquent
{
	protected $table = 'deliveries';
	protected $appends = ['is_active'];

	/**
	 * is delivery still active
	 *
	 * @return bool
	 */
	public function getIsActiveAttribute()
	{
		return new DateTime() < new DateTime($this->closing_time);
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