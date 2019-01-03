<?php
//combine permission data
return [
	'Posts' => [
		'Post' => [
			'admin.post.index',
			'admin.post.store',
			'admin.post.update',
			'admin.post.delete',
		],
		'Category' => [
			'admin.category.index',
			'admin.category.store',
			'admin.category.update',
			'admin.category.delete',
		],
		'Comments' => [
			'admin.post_comment.index',
			'admin.post_comment.store',
			'admin.post_comment.update',
			'admin.post_comment.delete',
			'admin.post_comment.reply'
		],
		
	],
];