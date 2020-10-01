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

Route::get('/', 'IndexController@index')->name('index');

// Route::get('/welcome', 'IndexController@welcome')->name('welcome');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'Internal'], function () {
		Route::get('/', 'Backend\IndexController@index')->name('backend.index');
		Route::get('/data-pesanan', 'Backend\IndexController@dataPesanan')->name('backend.data-pesanan');
    Route::get('/transaksi-meja', 'Backend\IndexController@transaksiMeja')->name('backend.transaksi-meja');
    Route::get('/dapur', 'Backend\IndexController@dapur')->name('backend.dapur');

		// Route::resource('meja', 'Backend\MejaController');
		Route::get('/meja', 'Backend\MejaController@index')->name('meja.index');
		Route::get('/kategori', 'Backend\KategoriController@index')->name('kategori.index');
	});

	Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
		Route::post('meja', 'Backend\MejaController@datatable')->name('meja');
	});
});
