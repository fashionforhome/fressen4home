<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Models
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

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeLastWeek($query)
	{
		return $query->where('created_at', '>', Carbon::now()->subWeek());
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeLastMonth($query)
	{
		return $query->where('created_at', '>', Carbon::now()->subMonth());
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeLastYear($query)
	{
		return $query->where('created_at', '>', Carbon::now()->subYear());
	}
}