<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;

Auth::routes();


Route::get('/', [
			'uses' => 'PostController@index',
			'as' => 'posts.index'
		]);


Route::get('/posts/{post}-{slug}', [
		'as' => 'posts.show',
		'uses' => 'PostController@show'
	])->where('post','\d+');//[0-9]+