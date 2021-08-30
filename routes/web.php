<?php

use Illuminate\Support\Facades\Route;
use App\Events\OrderStatusChanged;
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

Route::get('/fire', function () {
    event(new OrderStatusChanged);
    return 'Fired';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/order', 'PizzaController@create');
Route::get('/myorders', 'PizzaController@index');
Route::get('/myorders/{order}', 'PizzaController@show')->name('user.orders.show');
Route::post('/order/store','PizzaController@store')->name('orders.store');

Route::prefix('admin')->group(function() {
    Route::get('/login','Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/order/edit/{order}', 'Admin\AdminController@edit')->name('admin.order.edit');
    Route::patch('/order/{order}', 'Admin\AdminController@update')->name('admin.order.update');
});


Route::resource('/property', 'PropertyController');


