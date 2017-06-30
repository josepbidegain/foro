<?php

Route::get('/home', 'HomeController@index');

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

Route::post('comments/{comment}/accept', [
	'uses' => 'CommentController@accept',
	'as' => 'comments.accept'
]);

Route::post('posts/{post}/subscribe', [
	'uses' => 'SubscriptionController@subscribe',
	'as' => 'posts.subscribe'
]);

?>