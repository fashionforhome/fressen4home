<?php

class Store extends Eloquent
{
	/**
	 * internal cache for performance methods
	 *
	 * @var array
	 */
	private $statistics = [];

	/**
	 * Relationship to the model Dish
	 *
	 * @return mixed
	 */
	public function dishes()
	{
		return $this->hasMany('Dish');
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
	 * get the spend amount of a given user in the current store
	 *
	 * @param User $user
	 * @return int
	 */
	public function spendByUser(User $user)
	{
		return $this->evalStatistics($user)['spend'];
	}

	/**
	 * get the amount of orders in current store done by a given user
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function ordersByUser(User $user)
	{
		return $this->evalStatistics($user)['ordersCount'];
	}

	/**
	 * calculate statistics
	 *
	 * @param User $user
	 * @return mixed
	 */
	private function evalStatistics(User $user)
	{
		if (!isset($this->statistics[$user->getKey()])) {
			$totalPrice = 0;
			$orderCount = 0;

			$orders = Order::query()
				->whereUserId($user->getKey())
				->get();

			foreach ($orders as $order) {
				if ($order->delivery->store == $this) {
					$totalPrice += $order->dish->price;
					$orderCount++;
				}
			}

			$this->statistics[$user->getKey()] = [
				'spend' => $totalPrice,
				'ordersCount' => $orderCount
			];
		}

		return $this->statistics[$user->getKey()];
	}
}