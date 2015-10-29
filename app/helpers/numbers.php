<?php

/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Helpers
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
class Numbers
{
	/**
	 * @param $number
	 * @param int $decimalShift
	 * @return string
	 */
	static public function money($number, $decimalShift = 0)
	{
		$rounded = $number * pow(10, -$decimalShift);

		return number_format ($rounded, 2, ',', '.') . ' €';
	}
}