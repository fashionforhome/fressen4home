<?php

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
     * Get remaining time until delivery is closed
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

}