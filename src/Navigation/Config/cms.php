<?php
//combine menu structure
return [
	'admin' => [
		'menu' => [
			'Navigations' => [
				'url' => '#',
				'icon' => 'fa fa-list',
				'submenu' => [
					'Group' => [
						'icon' => '',
						'route' => 'admin.navigation.index'
					],
					'Item' => [
						'icon' => '',
						'route' => 'admin.navigation.item.index'
					]
				],
				'sort' => 1,
			],
		],

		//dicocokkan dengan route di module Site
		'navigation_route_used' => [
			'category_slug' => 'front.category',
			'post_slug' => 'front.post.detail',
			'page_slug' => 'front.page.detail',
		]
	]
];

