<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	protected $appends = ['name', 'spend_last_week', 'spend_last_month', 'spend_last_year'];

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
	 * Relationship to the model Delivery
	 *
	 * @return mixed
	 */
	public function deliveries()
	{
		return $this->hasMany('Delivery');
	}
	
	/**
	 * Registers a user by hashing the password and saving the model.
	 *
	 * @param string $email
	 * @param string $password
	 * @throws LogicException
	 */
	public function register($email, $password)
	{
		if (empty($this->id) === false) {
			throw new \LogicException('User seems to be already registered');
		}

		$this->email = $email;
		$this->password = Hash::make($password);
		$this->save();
	}

	/**
	 * Gets the users name by extracting it from the email address.
	 *
	 * @return string
	 */
	public function getNameAttribute()
	{
		if (empty($this->email)) {
			return '';
		}
		$parts = explode('@', $this->email);
		return array_shift($parts);
	}

	/**
	 * @return int
	 */
	public function getSpendLastWeekAttribute()
	{
		$totalPrice = 0;
		foreach ($this->orders()->lastWeek()->get() as $order) {
			$totalPrice += $order->dish->price;
		}

		return $totalPrice;
	}

	/**
	 * @return int
	 */
	public function getSpendLastMonthAttribute()
	{
		$totalPrice = 0;
		foreach ($this->orders()->lastMonth()->get() as $order) {
			$totalPrice += $order->dish->price;
		}

		return $totalPrice;
	}

	/**
	 * @return int
	 */
	public function getSpendLastYearAttribute()
	{
		$totalPrice = 0;
		foreach ($this->orders()->lastYear()->get() as $order) {
			$totalPrice += $order->dish->price;
		}

		return $totalPrice;
	}
}