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

Route::get('/', 'login@index');
Route::get('login', 'login@index');
Route::post('login', 'login@doLogin');


Route::get('register', 'register@index');
Route::post('register', 'register@create');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//dashboard

Route::get('logout', 'pages@logout');


//data user
Route::get('userData', 'userData@index');

Route::get('editUser/{id}', 'userData@editUser');
Route::post('editUser', 'userData@saveEditUser');

Route::get('deleteUser/{id}', 'userData@deleteUser');