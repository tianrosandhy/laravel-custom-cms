<?php
Route::post('post/table', 'PostController@table')->name('admin.post.datatable');
Route::post('category/table', 'CategoryController@table')->name('admin.category.datatable');
Route::post('post_comment/table', 'PostCommentController@table')->name('admin.post_comment.datatable');
