<?php


return [
	'user' => [
		'left' => [
			'delivery.active'   => [
				'label' => 'Active Deliveries'
			],
			'store.all'         => [
				'label' => 'Stores',
				'also'  => ['store.dish']
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