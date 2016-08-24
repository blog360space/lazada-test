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

Route::get('/', function () {
    return view('welcome');
});
/**
 * tags
 */
Route::post('/tag', 'TagController@create');

Route::get('/tag/{id?}', 'TagController@index');

Route::put('/tag/{id?}', 'TagController@update');

Route::delete('/tag/{id?}', 'TagController@delete');

/**
 * posts
 */
Route::post('/post', 'PostController@create');

Route::get('/post/{id?}', 'PostController@index');

Route::put('/post/{id?}', 'PostController@update');

Route::delete('/post/{id?}', 'PostController@delete');

Route::get('/post/tags/{tags?}', 'PostController@tags');

Route::get('/post/count/{tags?}', 'PostController@count');