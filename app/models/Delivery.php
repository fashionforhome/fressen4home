<?php

class Delivery extends Eloquent
{
	protected $table = 'deliveries';
	protected $appends = ['is_active', 'remaining_time', 'total_price'];

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
		return new DateTime() < new DateTime($this->closing_time);
	}

    /**
     * Get remaining time until delivery is closed
     *
     * @return string
     */
    public function getRemainingTimeAttribute()
    {
        $pattern = '%i min';

        $now = new DateTime();
        $diff = $now->diff(new DateTime($this->closing_time));

        if ($diff->h > 0) {
            $pattern = '%h h ' . $pattern;
        }
        return $diff->format($pattern);
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
        return $query->where('closing_time', '>', date('Y-m-d H:i:s'));
    }

}