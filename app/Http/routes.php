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

//authentication
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// check for logged in user
Route::group(['middleware' => ['auth']], function()
{
    Route::resource('post', 'PostController', [
    ]);
    Route::get('post/{id}/delete', 'PostController@destroy');
    Route::post('post/{id}/edit', 'PostController@update');
});

Route::get('/',['as' => 'home', 'uses' => 'PostController@index']);
Route::get('post/{slug}', 'PostController@show');
