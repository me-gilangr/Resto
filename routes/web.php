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

		Route::get('/meja', 'Backend\MejaController@index')->name('meja.index');
		Route::get('/kode-group', 'Backend\KodeGroupController@index')->name('kode-group.index');
		Route::get('/kategori', 'Backend\KategoriController@index')->name('kategori.index');
		Route::get('/produk', 'Backend\ProdukController@index')->name('produk.index');
		Route::get('/menu', 'Backend\MenuController@index')->name('menu.index');
		Route::get('/menu/create', 'Backend\MenuController@create')->name('menu.create');
		Route::post('/menu', 'Backend\MenuController@store')->name('menu.store');
		Route::get('/menu/{menu}/edit', 'Backend\MenuController@edit')->name('menu.edit');
		Route::put('/menu/{menu}', 'Backend\MenuController@update')->name('menu.update');
		Route::delete('/menu/{menu}', 'Backend\MenuController@destroy')->name('menu.destroy');

		// Route::resource('menu', 'Backend\MenuController');
	});

	Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
		Route::post('meja', 'Backend\MejaController@datatable')->name('meja');
		Route::post('kode-group', 'Backend\KodeGroupController@datatable')->name('kode-group');
		Route::post('kategori', 'Backend\KategoriController@datatable')->name('kategori');
		Route::post('produk', 'Backend\ProdukController@datatable')->name('produk');
		Route::post('menu', 'Backend\MenuController@datatable')->name('menu');
	});
});
