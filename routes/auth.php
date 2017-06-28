<?php


//Posts
Route::get('posts/create', [
	'uses' => 'CreatePostController@create',
	'as' => 'posts.create'
]);

Route::post('posts', [
	'uses' => 'CreatePostController@store',
	'as' => 'posts.store'
]);

Route::post('posts/{post}/comments', [
	'uses' => 'CommentController@store',
	'as' => 'comments.store'
]);

?>