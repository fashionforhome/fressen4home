<?php


return [
	'user' => [
		'left' => [
			'deliveries.active' => [
				'label' => 'Active Deliveries'
			],
			'stores.all'        => [
				'label' => 'Stores',
				'also' => ['store.dishes']
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