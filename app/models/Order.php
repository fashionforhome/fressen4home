<?php

use Carbon\Carbon;

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

	/**
	 * determine whether the user delete the order
	 *
	 * @param User $user
	 * @return bool
	 */
	public function allowedToDelete(User $user)
	{
		return ($this->user == $user || $this->delivery->user == $user) && $this->delivery->is_active;
	}

	/**
	 * determine whether the user can change the paid status of the order
	 *
	 * @param User $user
	 * @return bool
	 */
	public function allowedToChangePaid(User $user)
	{
		return $this->delivery->user == $user;
	}

    /**
     * Query scope for unpaid orders
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnpaid($query)
    {
        return $query->wherePaid(false);
    }

}