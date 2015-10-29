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

class Delivery extends Eloquent
{
	protected $table = 'deliveries';
	protected $appends = ['is_active', 'remaining_time', 'total_price'];
	protected $fillable = array('store_id', 'closing_time', 'user_id');

	/**
	 * add date mutators
	 *
	 * @return array
	 */
	public function getDates()
	{
		return array('closing_time');
	}

	/**
	 * returns the total price for the delivery
	 *
	 * @return int
	 */
	public function getTotalPriceAttribute()
	{
		$price = 0;
		foreach ($this->orders as $order) {
			$price += $order->dish->price;
		}

		return $price;
	}

	/**
	 * is delivery still active
	 *
	 * @return bool
	 */
	public function getIsActiveAttribute()
	{
		return Carbon::now() < $this->closing_time;
	}

    /**
     * Get remaining time until delivery is closed.
     * Returns '0', if delivery is already closed.
     *
     * @return string
     */
    public function getRemainingTimeAttribute()
    {
	    $diffInHours = Carbon::now()->diffInHours($this->closing_time, false);
	    $diffInMinutes = Carbon::now()->diffInMinutes($this->closing_time, false);

	    $diffInHours = $diffInHours < 0 ? 0 : $diffInHours;
	    $diffInMinutes = $diffInMinutes < 0 ? 0 : $diffInMinutes % 60;

        if ($diffInHours > 0) {
            return sprintf('%d h %d min', $diffInHours, $diffInMinutes);
        } else {
            return sprintf('%d min', $diffInMinutes);
        }
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

    /**
     * Query scope for active deliveries
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('closing_time', '>', Carbon::now());
    }

	/**
	 * determine whether the user is allowed to delete the delivery
	 *
	 * @param User $user
	 * @return bool
	 */
	public function allowedToDelete(User $user)
	{
		return $this->user == $user && $this->orders->count() == 0;
	}

	/**
	 * is user allowed to close the delivery
	 *
	 * @param User $user
	 * @return bool
	 */
	public function allowedToClose(User $user)
	{
		return $this->user == $user && $this->orders->count() == 0;
	}

	/**
	 * close the delivery
	 *
	 * @return $this
	 */
	public function close()
	{
		$this->closing_time = Carbon::now();
		$this->save();

		return $this;
	}

	/**
	 * on delete
	 *
	 * @return bool|null|void
	 */
	public function delete()
	{
		// delete all orders
		$this->orders()->delete();

		return parent::delete();
	}
}