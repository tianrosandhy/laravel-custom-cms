<?php
Route::get('post/export', 'PostController@export')->name('admin.post.export');
Route::post('post/switch', 'PostController@switch')->name('admin.post.switch');
Route::get('post', 'PostController@index')->name('admin.post.index');
Route::get('post/create', 'PostController@create')->name('admin.post.store');
Route::post('post/create', 'PostController@store');
Route::get('post/{id}', 'PostController@edit')->name('admin.post.edit');
Route::post('post/{id}', 'PostController@update')->name('admin.post.update');
Route::post('post/delete/{id}', 'PostController@delete')->name('admin.post.delete');

Route::get('category/export', 'CategoryController@export')->name('admin.category.export');
Route::post('category/switch', 'CategoryController@switch')->name('admin.category.switch');
Route::get('category', 'CategoryController@index')->name('admin.category.index');
Route::get('category/create', 'CategoryController@create')->name('admin.category.store');
Route::post('category/create', 'CategoryController@store');
Route::get('category/{id}', 'CategoryController@edit')->name('admin.category.edit');
Route::post('category/{id}', 'CategoryController@update')->name('admin.category.update');
Route::post('category/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');

Route::get('post_comment/remove_spam', 'PostCommentController@removeSpam')->name('admin.post_comment.remove_spam');
Route::get('post_comment/reply/{id}', 'PostCommentController@reply')->name('admin.post_comment.reply');
Route::post('post_comment/reply/{id}', 'PostCommentController@postReply')->name('admin.post_comment.postreply');

Route::get('post_comment/export', 'PostCommentController@export')->name('admin.post_comment.export');
Route::post('post_comment/switch', 'PostCommentController@switch')->name('admin.post_comment.switch');
Route::get('post_comment', 'PostCommentController@index')->name('admin.post_comment.index');
Route::get('post_comment/create', 'PostCommentController@create')->name('admin.post_comment.store');
Route::post('post_comment/create', 'PostCommentController@store');
Route::get('post_comment/{id}', 'PostCommentController@edit')->name('admin.post_comment.edit');
Route::post('post_comment/{id}', 'PostCommentController@update')->name('admin.post_comment.update');
Route::post('post_comment/delete/{id}', 'PostCommentController@delete')->name('admin.post_comment.delete');
