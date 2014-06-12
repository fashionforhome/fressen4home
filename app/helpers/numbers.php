<?php

/**
 * Class Numbers
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

		return number_format ($rounded, 2, ',', '.') . '€';
	}
}