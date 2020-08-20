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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'PageController@home');

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::post('/register_client', ['as'=>'register.client', 'uses'=>'Auth\RegisterController@createClient']);

Route::get('/social/{provider}', 'SocialController@login');
Route::get('/social/callback/{provider}', 'SocialController@callback');

Route::get('/user', ['as'=>'user.profile', 'middleware'=>'client', 'uses'=>'UserProfileController@profile']);

Route::get('/user/edit', ['as'=>'user.profile.edit', 'middleware'=>'client', 'uses'=>'UserProfileController@edit']);
Route::post('/user/edit', ['as'=>'user.profile.save', 'middleware'=>'client', 'uses'=>'UserProfileController@edit']);
Route::get('/user/avatar', ['as'=>'user.avatar.edit', 'middleware'=>'client', 'uses'=>'UserProfileController@avatar']);
Route::post('/user/avatar', ['as'=>'user.avatar.save', 'middleware'=>'client', 'uses'=>'UserProfileController@avatar']);
Route::get('/user/avatar/delete', ['as'=>'user.avatar.delete', 'middleware'=>'client', 'uses'=>'UserProfileController@dell_avatar']);
Route::get('/user/password', ['as'=>'user.password.edit', 'middleware'=>'client', 'uses'=>'UserProfileController@edit_password']);
Route::post('/user/password', ['as'=>'user.password.save', 'middleware'=>'client', 'uses'=>'UserProfileController@edit_password']);

Route::get('/user/orders', ['as'=>'user.orders', 'middleware'=>'client', 'uses'=>'OrderController@order_list']);
Route::get('/user/order/{id}', ['as'=>'user.order', 'middleware'=>'client', 'uses'=>'OrderController@order']);

Route::get('/order', ['as'=>'order.add', 'middleware'=>'client', 'uses'=>'OrderController@add_order']);
Route::post('/order', ['as'=>'order.save', 'middleware'=>'client', 'uses'=>'OrderController@add_order']);
Route::get('/user/order-modal', ['as'=>'user.order.modal', 'middleware'=>'client', 'uses'=>'UserProfileController@profile']);

Route::post('/user/order/repair_save', ['as'=>'order.repair.save', 'middleware'=>'client', 'uses'=>'OrderController@user_consent']);

Route::get('/home', ['as'=>'home', 'uses'=>'PageController@home']);
Route::get('/contacts', ['as'=>'contacts', 'uses'=>'PageController@contacts']);
Route::get('/mail', ['as'=>'mail', 'uses'=>'PageController@mail']);
Route::post('/mail', ['as'=>'send.mail', 'uses'=>'PageController@send_mail']);
Route::get('/stock', ['as'=>'stock.list', 'uses'=>'StockController@listStock']);
Route::get('/stock/{id}', ['as'=>'stock', 'uses'=>'StockController@stock']);
Route::get('/news', ['as'=>'news', 'uses'=>'NewsController@index']);
Route::get('/news/{id}', ['as'=>'news_id', 'uses'=>'NewsController@news']);

//Route::get('/login_admin', ['as'=>'login.admin', 'uses'=>'Auth\LoginController@showLoginForm']);
//Route::post('/login_admin', ['as'=>'login.admin.auth', 'uses'=>'Auth\LoginController@login']);
//Route::get('/admin', ['as'=>'admin.dashboard']);
//Route::get('/admin/logout', ['as'=>'admin.logout', 'uses'=>'Auth\LoginController@logout']);

Route::post('upload-image', ['as'=>'upload_image', 'uses'=>'FileUploadController@uploader']);

Route::post('/search', ['as'=>'search', 'uses'=>'SearchController@search']);
Route::get('/search', ['as'=>'search.home', function(){ return redirect(url('/'));}]);

Route::get('/{url}', ['as'=>'page', 'uses'=>'PageController@page']);
