<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Models
 *
 * @author Eduard Bess <eduard.bess@fashion4home.de>
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

    /**
     * @return string
     */
    public function getDeliveriesTodayAttribute()
    {
        $deliveries = array();
        $orders = $this->orders()->where('created_at', '>=', Carbon\Carbon::today())->get();
        foreach ($orders as $order) {
            $deliveries[] = $order->delivery->getKey();
        }

        return array_unique($deliveries);
    }

}