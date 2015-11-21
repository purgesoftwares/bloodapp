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

$app->get('/', function() {
    return view('index');
});

$app->get('auth/log', ['uses' => 'App\Http\Controllers\Auth\AuthController@getLog']);
$app->post('auth/login', ['uses' => 'App\Http\Controllers\Auth\AuthController@postLogin']);
$app->get('auth/logout', ['uses' => 'App\Http\Controllers\Auth\AuthController@getLogout']);
$app->get('auth/register', ['uses' => 'App\Http\Controllers\Auth\AuthController@getRegister']);
$app->post('auth/register', ['uses' => 'App\Http\Controllers\Auth\AuthController@postRegister']);
$app->get('auth/profile', ['uses' => 'App\Http\Controllers\Auth\AuthController@getProfile']);
$app->post('auth/profile', ['uses' => 'App\Http\Controllers\Auth\AuthController@postProfile']);

$app->get('password/email', ['uses' => 'App\Http\Controllers\Auth\PasswordController@getEmail']);
$app->post('password/email', ['uses' => 'App\Http\Controllers\Auth\PasswordController@postEmail']);
$app->get('password/reset/{token}', ['uses' => 'App\Http\Controllers\Auth\PasswordController@getReset']);
$app->post('password/reset', ['uses' => 'App\Http\Controllers\Auth\PasswordController@postReset']);


$app->get('dream', ['uses' => 'App\Http\Controllers\DreamController@index']);
$app->post('dream', ['uses' => 'App\Http\Controllers\DreamController@store']);
$app->put('dream/{id}', ['uses' => 'App\Http\Controllers\DreamController@update']);
$app->delete('dream/{id}', ['uses' => 'App\Http\Controllers\DreamController@destroy']);


$app->get('user', ['uses' => 'App\Http\Controllers\UserController@index']);
$app->post('user', ['uses' => 'App\Http\Controllers\UserController@store']);
$app->put('user/{id}', ['uses' => 'App\Http\Controllers\UserController@update']);
$app->delete('user/{id}', ['uses' => 'App\Http\Controllers\UserController@destroy']);


$app->group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers'], function($app)
{
	$app->get('auth/log', ['uses' => 'Auth\AuthController@getLog']);
	$app->post('auth/login', ['uses' => 'Auth\AuthController@login']);
	$app->get('auth/logout', ['uses' => 'Auth\AuthController@getLogout']);
	$app->post('auth/register', ['uses' => 'Auth\AuthController@apiRegister']);
	$app->get('auth/profile', ['uses' => 'Auth\AuthController@getApiProfile']);
	$app->post('auth/profile', ['uses' => 'Auth\AuthController@apiProfile']);
	
	$app->get('user', ['uses' => 'UserController@index']);
});



