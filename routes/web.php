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

Route::get('/', 'ProductsController@index');

Route::get('/details/{id}', 'ProductsController@show')->middleware('verified');

Route::get('/create', 'ProductsController@create')->middleware('verified');
Route::post('/store', 'ProductsController@store')->middleware('verified');

Route::post('/update/{id}', 'ProductsController@update')->middleware('verified');

Route::get('/edit/{id}', 'ProductsController@edit')->middleware('verified');

Auth::routes();

// Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
