<?php

use Carbon\Carbon;
use \Illuminate\Support\MessageBag;

class DeliveryController extends BaseController {

	/**
	 * Display a listing of all active deliveries.
	 *
	 * @return Response
	 */
	public function getOverviewOfActive()
	{
        return View::make('delivery.active', [
	        'activeDeliveries' => Delivery::active()->get()->sortBy('closing_time'),

	        // create form data
	        'now' => $this->getDateTimeAfterNow(10)->format('Y-m-d H:i:s'),
			'stores' => Store::all()
        ]);
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
	 * create a delivery
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postCreate()
	{
		$nowDateTime = $this->getDateTimeAfterNow(5);
		$validator = Validator::make(
			Input::all(), 
			array(
				'store' => 'required|numeric|exists:stores,id',
				'closing_time' => 'date_format:Y-m-d H:i:s|after:' . $nowDateTime->format('Y-m-d H:i:s')
			)
		);
		
		if ($validator->passes() === false) {
			return Redirect::back()->withErrors($validator);
		}

		$storeId = Input::get('store');
		$closingTime = Input::get('closing_time');

        $store = Store::find($storeId);

		$delivery = new Delivery();
		$delivery->user()->associate(Auth::user());
		$delivery->store()->associate($store);
		$delivery->closing_time = $closingTime;
		$delivery->save();

        // push notification
        F4H\Pusher::push('delivery.created', array(
            'user' => Auth::user()->email,
            'store' => $store->name,
            'closing_time' => $closingTime,
            'delivery' => $delivery->getKey()
        ));

        return Redirect::route('delivery.active');
	}

    /**
     * notify subscribers about incoming delivery
     *
     * @param $deliveryId
     */
    public function getIncoming($deliveryId)
    {
        $delivery = Delivery::find($deliveryId);
        if($delivery && $delivery->user == Auth::user()) {
            F4H\Pusher::push('delivery.incoming', array(
                'user' => Auth::user()->email,
                'store' => $delivery->store->name,
                'delivery' => $delivery->getKey()
            ));
        }

        return Redirect::back();
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
	public function getOverview($id)
	{
		$delivery = Delivery::find($id);

		// if no delivery with given id loaded
		if (!$delivery) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		return View::make('delivery.overview', ['delivery' => $delivery]);
	}

	/**
	 * returns a carbon time in $minutes
	 *
	 * @param int $minutes
	 * @return mixed
	 */
	private function getDateTimeAfterNow($minutes = 0)
	{
		return Carbon::now()->addMinutes($minutes);
	}

	/**
	 * delete the delivery if is possible
	 *
	 * @param $deliveryId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDelete($deliveryId)
	{
		// if cant load
		if (!($delivery = Delivery::find($deliveryId))) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		// if not allowed
		if (!$delivery->allowedToDelete(Auth::user())) {
			return Redirect::back()
				->with('errors', new MessageBag([
					'You are not allowed to delete the delivery.',
					'It\'s got to be your delivery and having no orders'
				]));
		}

		$delivery->delete();

		$messages = new MessageBag();
		$messages->add('success', 'Successfully deleted your delivery!');

		return Redirect::route('user.deliveries')
			->with('messages', $messages);
	}

	/**
	 * close a delivery
	 *
	 * @param $deliveryId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postClose($deliveryId)
	{
		// if cant load
		if (!($delivery = Delivery::find($deliveryId))) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		// if not allowed
		if (!$delivery->allowedToClose(Auth::user())) {
			return Redirect::back()
				->with('errors', new MessageBag([
					'You are not allowed to close the delivery.',
					'It\'s got to be your delivery and having no orders'
				]));
		}

		$delivery->close();

		$messages = new MessageBag();
		$messages->add('success', 'Successfully closed your delivery!');

		return Redirect::back()
			->with('messages', $messages);
	}
}
