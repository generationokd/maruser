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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main','mainController@index');
Route::get('/main/serch','mainController@index');
Route::post('/main/serch','mainController@serch');


Route::get('/search','searchController@index');
Route::get('/favorite','favoriteController@index');
Route::get('/history','historyController@index');
Route::post('/history/delete','historydeleteController@index');
Route::get('/login','loginController@index');
Route::post('/main','loginController@logincheck');
Route::get('/logout','logoutController@index');
Route::post('/logout','logoutController@index');
Route::get('/regist/input','registController@input');
Route::post('/regist/input','registController@input');
Route::get('/regist/confirm','registController@confirm');
Route::post('/regist/confirm','registController@registcheck');
Route::get('/regist/complete','registController@complete');
Route::post('/regist/complete','registController@regist');