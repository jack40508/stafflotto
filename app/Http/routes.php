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

Route::get('stafflotto/{index}/update', 'StaffLottoController@update');  //鍵盤事件專用路徑


Route::get('backstage', 'BackstageController@index');

Route::get('backstage/{index}', 'BackstageController@show');

Route::get('backstage/{index}/{code}/edit', 'BackstageController@edit');

Route::patch('backstage/{index}/{code}/update', 'BackstageController@update');

Route::patch('backstage/{index}/{code}/delete', 'BackstageController@delete');

Route::get('backstage/{index}/insert', 'BackstageController@insert');

Route::patch('backstage/{index}/create', 'BackstageController@create');

Route::get('backstage/{index}/{code}/{index2}', 'BackstageController@showdeep');

Route::get('backstage/{index}/{code}/{index2}/{code2}/edit', 'BackstageController@editdeep');

Route::patch('backstage/{index}/{code}/{index2}/{code2}/update', 'BackstageController@updatedeep');

Route::patch('backstage/{index}/{code}/{index2}/{code2}/delete', 'BackstageController@deletedeep');

Route::get('backstage/{index}/{code}/{index2}/insert', 'BackstageController@insertdeep');

Route::patch('backstage/{index}/{code}/{index2}/create', 'BackstageController@createdeep');

Route::post('backstage/excelimport', 'BackstageController@excel_import');

Route::patch('backstage/excelexport', 'BackstageController@excel_export');

Route::get('backstage/excel/exceldownload', 'BackstageController@excel_download');

Route::post('backstage/imageupload', 'BackstageController@image_upload');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
