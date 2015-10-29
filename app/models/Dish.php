<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Models
 *
 * @author Kolja Zuelsdorf <kolja.zuelsdorf@fashion4home.de>
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
class Dish extends Eloquent
{

    protected $fillable = array('store_dish_id', 'name', 'price');

	protected $table = 'dishes';

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
	 * Relationship to the model Store
	 *
	 * @return mixed
	 */
	public function store()
	{
		return $this->belongsTo('Store');
	}
}