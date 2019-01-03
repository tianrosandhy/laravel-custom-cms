<?php
//combine menu structure
return [
	'admin' => [
		'menu' => [
			'Posts' => [
				'url' => '#',
				'icon' => 'fa fa-book',
				'sort' => 1,
				'submenu' => [
					'Category' => [
						'route' => 'admin.category.index',
						'icon' => ''
					],
					'All Posts' => [
						'route' => 'admin.post.index',
						'icon' => ''
					],
					'Comments' => [
						'route' => 'admin.post_comment.index',
						'icon' => ''
					],
				]
			],
		],
	]
];