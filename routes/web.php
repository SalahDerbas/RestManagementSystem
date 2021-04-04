<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reservation', 'HomeController@reservation')->name('reservation');
Route::post('/reserve', 'HomeController@reserve')->name('reserve');
Route::get('/meals', 'HomeController@meals')->name('meals');
Route::get('/show/meal/{meal}', 'HomeController@showMeal')->name('show.meal');



Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/home', 'AdminController@index')->name('home');
    Route::get('/income', 'AdminController@income')->name('income');

    Route::get('/create/casher', 'AdminController@createCasher')->name('create.casher');
    Route::post('/store/casher', 'AdminController@storeCasher')->name('store.casher');
    Route::get('/cashers', 'AdminController@cashers')->name('cashers');
    Route::get('/casher/{casher}/edit', 'AdminController@editCasher')->name('edit.casher');
    Route::post('/casher/{casher}/update', 'AdminController@updateCasher')->name('update.casher');
    Route::post('/casher/delete', 'AdminController@deleteCasher')->name('delete.casher');

    Route::get('/create/category', 'AdminController@createCategory')->name('create.category');
    Route::post('/store/category', 'AdminController@storeCategory')->name('store.category');
    Route::get('/categories', 'AdminController@categories')->name('categories');
    Route::get('/category/{category}/edit', 'AdminController@editCategory')->name('edit.category');
    Route::post('/category/{category}/update', 'AdminController@updateCategory')->name('update.category');
    Route::post('/category/delete', 'AdminController@deleteCategory')->name('delete.category');

    Route::get('/create/meal', 'AdminController@createMeal')->name('create.meal');
    Route::post('/store/meal', 'AdminController@storeMeal')->name('store.meal');
    Route::get('/meals', 'AdminController@meals')->name('meals');
    Route::get('/meal/{meal}/edit', 'AdminController@editMeal')->name('edit.meal');
    Route::post('/meal/{meal}/update', 'AdminController@updateMeal')->name('update.meal');
    Route::post('/meal/delete', 'AdminController@deleteMeal')->name('delete.meal');

    Route::get('/reservations', 'AdminController@reservations')->name('reservations');
    Route::get('/reservation/{reservation}/edit', 'AdminController@editReservation')->name('edit.reservation');
    Route::post('/reservation/{reservation}/update', 'AdminController@updateReservation')->name('update.reservation');
    Route::post('/reservation/delete', 'AdminController@deleteReservation')->name('delete.reservation');
    Route::get('/reservation/{reservation}/orders', 'AdminController@orders')->name('orders');
    Route::post('/order/delete', 'AdminController@deleteOrder')->name('delete.order');

    Route::get('/reports', 'AdminController@reports')->name('reports');
    Route::get('/report/{report}/edit', 'AdminController@editReport')->name('edit.report');
    Route::post('/report/{report}/update', 'AdminController@updateReport')->name('update.report');
    Route::post('/report/delete', 'AdminController@deleteReport')->name('delete.report');

});

Route::namespace('Casher')->prefix('casher')->as('casher.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/home', 'CasherController@index')->name('home');

    Route::get('/reservations', 'CasherController@reservations')->name('reservations');
    Route::get('/reservation', 'CasherController@reservation')->name('reservation');
    Route::get('/reservation/{reservation}/edit', 'CasherController@editReservation')->name('edit.reservation');
    Route::post('/reservation/{reservation}/update', 'CasherController@updateReservation')->name('update.reservation');
    Route::post('/reservation/delete', 'CasherController@deleteReservation')->name('delete.reservation');
    Route::post('/reserve', 'CasherController@reserve')->name('reserve');

    Route::get('/reservation/{reservation}/orders', 'CasherController@orders')->name('orders');
    Route::get('/order/{order}/edit', 'CasherController@editOrder')->name('edit.order');
    Route::get('/order/quantity', 'CasherController@orderQuantity')->name('order.quantity');
    Route::get('/order/store/quantity/{ords}', 'CasherController@storeOrderQuantity')->name('store.order.quantity');
    Route::post('/order/{order}/update', 'CasherController@updateOrder')->name('update.order');
    Route::post('/order/delete', 'CasherController@deleteOrder')->name('delete.order');
    Route::get('/reservation/{reservation}/order', 'CasherController@addOrder')->name('add.order');
    Route::post('/reservation/{reservation}/store/order', 'CasherController@storeOrder')->name('store.order');

    Route::get('/reports', 'CasherController@reports')->name('reports');
    Route::get('/add/report', 'CasherController@addReport')->name('add.report');
    Route::post('/store/report', 'CasherController@storeReport')->name('store.report');
    Route::get('/report/{report}/edit', 'CasherController@editReport')->name('edit.report');
    Route::post('/report/{report}/update', 'CasherController@updateReport')->name('update.report');
    Route::post('/report/delete', 'CasherController@deleteReport')->name('delete.report');

});

