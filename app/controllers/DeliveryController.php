<?php

use \Illuminate\Support\MessageBag;

class DeliveryController extends BaseController {

	/**
	 * Display a listing of all active deliveries.
	 *
	 * @return Response
	 */
	public function getOverviewOfActive()
	{
        return View::make('delivery.active', ['activeDeliveries' => Delivery::active()->get()->sortBy('closing_time')]);
	}

	/**
	 * show all available dishes for a certain
	 *
	 * @param integer $id Delivery ID
	 * @return \Illuminate\View\View
	 */
	public function getStoreDishes($id)
	{
		if ($delivery = Delivery::find($id)) {
			return View::make('delivery.store.dishes', ['delivery' => $delivery]);
		}
	}

	/**
	 * add a dish order to a delivery
	 *
	 * @param $deliveryId
	 * @param $dishId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postAddOrder($deliveryId, $dishId)
	{
		$delivery = Delivery::find($deliveryId);
		$dish = Dish::find($dishId);

		// if delivery and dish is not loaded correctly
		if (!$delivery || !$dish) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		// if delivery closed
		if (!$delivery->is_active) {
			return Redirect::back()
				->with('errors', new MessageBag(['Delivery already closed.']));
		}

		// place order
		$order = new Order();

		// attach to relations
		$order->user()->associate(Auth::user());
		$order->delivery()->associate($delivery);
		$order->dish()->associate($dish);

		$order->save();

		// messages
		$messages = new MessageBag();
		$messages->add('success', 'Successfully ordered a dish!');
		$messages->add('success', 'The order has been attached to the delivery.');

		return Redirect::back()
			->with('messages', $messages);
	}

	/**
	 * show the delivery related order data
	 */
	public function getOrderOverview($id)
	{
		$delivery = Delivery::find($id);

		// if no delivery with given id loaded
		if (!$delivery) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		return View::make('delivery.order.overview', ['delivery' => $delivery]);
	}
}
