<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as' => 'blog.index', 'uses' => 'Blog\BlogController@index']);
Route::get('/post/{id}',['as' => 'blog.posts.view', 'uses' => 'Blog\BlogController@getPost']);

Route::get('/sobre',['as' => 'blog.about', 'uses' => 'Blog\BlogController@about']);