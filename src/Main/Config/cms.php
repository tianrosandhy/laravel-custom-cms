<?php
return [
	'max_filesize' => [
		//sekalipun sudah dilimit (dalam MB), tapi kalau dari servernya cuma support dibawah X MB, yg dipakai adalah nilai terkecil
		'image' => 2,
		'file' => 5
	],

	'lang' => [
		'active' => true, //if you dont need the translate module, just set to false
		'available' => [
			'en',
			'id',
		],
		'default' => 'en',
	],


	'admin' => [
		'prefix' => 'p4n3lb04rd',
		'assets' => 'admin_theme',
		'minified' => true,
		'jquery_version' => 1, //1 or 3 only
		'logo' => 'theme/img/logo_maxsol.png',
		'register' => true,
		'components' => [
			'userinfo' => true,
		],
		'email_receiver' => 'tianrosandhy@gmail.com',

		'menu' => [
			'Dashboard' => [
				'url' => '',
				'icon' => 'fa fa-home',
				'sort' => -9999,
			],

			'Settings' => [
				'url' => '#',
				'icon' => 'fa fa-users',
				'sort' => 10000,
				'submenu' => [
					'General' => [
						'route' => 'admin.setting.index',
						'icon' => '',
					],
					'Logs' => [
						'route' => 'admin.log.index',
						'icon' => '',
					],
				],
			],

			'User Managements' => [
				'url' => '#',
				'icon' => 'fa fa-users',
				'sort' => 9999,
				'submenu' => [
					'Priviledge' => [
						'route' => 'admin.permission.index',
						'icon' => ''
					],
					'User Lists' => [
						'route' => 'admin.user.index',
						'icon' => ''
					]

				]
			],

		],



	],

	'front' => [
		'assets' => 'front_assets',
		'minified' => true
	],

];