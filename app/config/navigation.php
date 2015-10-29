<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Config
 *
 * @author Eduard Bess <eduard.bess@fashion4home.de>
 *
 * @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 16.06.2014
 * Time: 22:04
 */

return [
	'user' => [
		'left' => [
			'delivery.active'   => [
				'label' => 'Active Deliveries'
			],
			'store.all'         => [
				'label' => 'Stores',
				'also'  => ['store.dishes']
			]
		],
		'right' => [
			'user.logout'       => [
				'label' => 'Logout'
			]
		]
	],
	'guest' => [
		'left' => [
		],
		'right' => [
			'user.login.form'       => [
				'label' => 'Login'
			],
			'user.register.form'    => [
				'label' => 'Register'
			]
		]
	]
];