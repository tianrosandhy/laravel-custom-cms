<?php
Route::get('/', 'HomeController@index');
Route::get('contact', 'HomeController@contact');
Route::post('contact', 'HomeController@contactProcess');

Route::get('search/{keyword}', 'PostController@search')->name('front.search');
Route::get('blog', 'PostController@index')->name('front.post.index');
Route::get('blog/{slug}', 'PostController@detail')->name('front.post.detail');
Route::get('blog/lazy-load/{page}', 'PostController@lazyLoad')->name('front.post.lazyload');
Route::post('blog/like/{id}/{nonce}', 'PostController@likeHandle')->name('front.post.like');
Route::post('blog/comment/{id}', 'PostController@commentHandle')->name('front.post.comment');	


Route::get('category/{slug}', 'PostController@category')->name('front.category');
Route::get('page/{slug}', 'PageController@index')->name('front.page.detail');

Route::get('project', 'ProjectController@index')->name('front.project');
Route::get('project/{slug}', 'ProjectController@detail')->name('front.project.detail');

Route::get('download/prompt/{slug}', 'DownloadController@index')->name('front.download');
Route::get('download/file/{hash}', 'DownloadController@getFile');
