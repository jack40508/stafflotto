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

Route::get('/', 'StaffLottoController@index');

Route::get('home', 'StaffLottoController@index');


Route::get('stafflotto', 'StaffLottoController@index');

Route::get('stafflotto/{index}', 'StaffLottoController@show');

Route::patch('stafflotto/{index}', 'StaffLottoController@update');


Route::get('backstage', 'BackstageController@index');

Route::get('backstage/{index}', 'BackstageController@show');

Route::get('backstage/{index}/{code}/edit', 'BackstageController@edit');

Route::patch('backstage/{index}/{code}', 'BackstageController@update');

Route::patch('backstage/{index}/{code}/delete', 'BackstageController@delete');

Route::get('backstage/{index}/insert', 'BackstageController@insert');

Route::patch('backstage/{index}', 'BackstageController@create');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
