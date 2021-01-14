<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'BerandaController@index');
Route::get('/product', 'BerandaController@product');
Route::get('/category/{id}', 'BerandaController@productbycategory')->name('category.product');
Route::get('/product/detail/{id}', 'BerandaController@detail');
Route::get('/penjual', 'BerandaController@penjual');
Route::get('/penjual/{id}', 'BerandaController@productbypenjual');
Route::get('/auth/register', 'AuthController@register');
Route::post('/auth/register', 'AuthController@store')->name('home.register');
Route::get('/verifikasi/register/{token}', 'AuthController@verifikasi');
Route::post('/auth/login', 'AuthController@login');

Route::post('/cart', 'CartController@index');
Route::get('/keranjang', 'CartController@keranjang');
Route::post('/cart/update','CartController@update');
Route::get('/cart/delete/{rowid}','CartController@delete');
Route::get('/cart/formulir', 'CartController@formulir');
Route::post('/cart/transaction', 'CartController@transaction');

Route::get('/cart/myorder','CartController@myorder');
Route::get('/cart/detail/{code}','CartController@detail');
Route::get('/myproduct','CartController@product');
Route::get('/addproduct','CartController@addproduct');
Route::post('/saveproduct','CartController@saveproduct');
Route::get('/editproduct/{id}','CartController@editproduct');
Route::post('/updateproduct','CartController@updateproduct');
Route::get('/deleteproduct/{id}','CartController@deleteproduct');
Route::get('/myprofil','BerandaController@myprofil');
Route::post('/updateprofil','BerandaController@updateprofil');
Route::get('/logout', 'BerandaController@logout');
Auth::routes();
Route::get('citybyid/{id}',function($id){
	return city($id);
});



Route::group(['prefix' => 'admin'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index');
    // Route::get('/category', 'CategoryController@index');
    // Route::post('/category', 'CategoryController@store');
    Route::resource('/category', 'CategoryController');
    Route::resource('/parent', 'ParentController');
    Route::resource('/product', 'ProductController');

    Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
    Route::get('/transaction/{id}/{status}', 'TransactionController@status');
    Route::get('/transaction/pengiriman/{id}/{status}', 'TransactionController@pengiriman');
    Route::get('/transaction/detail/{id}/data', 'TransactionController@detail');
    Route::get('/transaction/detail/{id}/data/cetak', 'TransactionController@cetakpdf');

    Route::get('/user', 'UserController@index')->name('admin.user');
    Route::get('/user/status/{id}', 'UserController@changestatus');
    Route::get('/user/add', 'UserController@create')->name('admin.user.create');
    Route::post('/user/add', 'UserController@store')->name('admin.user.store');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/delete/{id}', 'UserController@destroy')->name('admin.user.destroy');
});