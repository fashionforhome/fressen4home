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
 * Date: 12.06.2014
 * Time: 22:04
 */
class StoreController extends BaseController
{
	/**
	 * show all dishes for a specific store
	 *
	 * @param integer $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function getDishes($id)
	{
		if ($store = Store::find($id)) {
			return View::make('store.dishes', ['store' => $store]);
		}

		return Redirect::back();
	}

	/**
	 * show list of all stores
	 *
	 * @return \Illuminate\View\View
	 */
	public function getAll()
	{
		return View::make('store.all', ['stores' => Store::all()]);
	}
}