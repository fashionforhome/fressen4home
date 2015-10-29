<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Controllers
 *
 * @author Eduard Bess <eduard.bess@fashion4home.de>
 *
 * @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 13.06.2014
 * Time: 22:04
 */

use \Illuminate\Support\MessageBag;

class OrderController extends BaseController
{
	/**
	 * delete an order if the logged user has created the order or created the delivery
	 *
	 * @param integer $orderId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDelete($orderId)
	{
		$order = Order::find($orderId);

		// if order not loaded or user is not the delivery owner nor the creater of the order
		if (!$order || !$order->allowedToDelete(Auth::user())) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		$order->delete();

		// messages
		$messages = new MessageBag();
		$messages->add('success', 'Successfully deleted the order!');

		return Redirect::back()
			->with('messages', $messages);
	}

	/**
	 * change the paid status of an order
	 *
	 * @param integer $orderId
	 * @internal param bool $paid
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postChangePaid($orderId)
	{
		$order = Order::find($orderId);

		// if order not loaded or user is not the delivery owner
		if (!$order || !$order->allowedToChangePaid(Auth::user())) {
			return Redirect::back()
				->with('errors', new MessageBag(['An error has occurred.']));
		}

		$order->paid = (bool) !$order->paid;
		$order->save();

		return Redirect::back();
	}

}