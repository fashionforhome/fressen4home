<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

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
	public function getName()
	{
		if (empty($this->email)) {
			return '';
		}
		$parts = explode('@', $this->email);
		return array_shift($parts);
	}
}