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
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');

Route::get('/', 'ClienteController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'clientes',  'middleware' => 'auth'], function(){
	Route::get('/', 'ClienteController@index')->name('clientes.index');
	Route::get('list', 'ClienteController@list')->name('clientes.list');
	Route::get('info/{id}', 'ClienteController@info')->name('clientes.info');
	Route::post('store', 'ClienteController@store')->name('clientes.store');
	Route::put('update', 'ClienteController@update')->name('clientes.store');
	Route::delete('delete/{id}', 'ClienteController@delete')->name('clientes.delete');
});


