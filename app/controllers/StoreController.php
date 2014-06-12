<?php

/**
 * Class StoreController
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