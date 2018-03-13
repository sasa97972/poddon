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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/shop/{category?}', 'Site\ShopController@index')->name('shop');
Route::get('/shop/product/{product}', 'Site\ProductsController@show');
Route::get('/user', 'Site\Api\UsersController@user');
Route::get('/debug', 'DebugController@debug');
Route::resource("comments", 'Site\CommentsController');
Route::resource('order', 'Site\OrderController');
Route::resource('cart', 'Site\CartController');

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin');
    Route::get('/{category?}/{subcategory?}/{id?}', 'DashboardController@index');
});

