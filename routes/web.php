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
Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe');
Route::delete('/subscribe', 'HomeController@unsubscribe')->name('subscribe.delete');

Route::get('/page/{token}', 'HomeController@page')->name('page');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
    Route::get('', 'AdminController@index')->name('index');

    //TODO: move to resource
    Route::post('subscription', 'AdminController@storeSubscription')->name('subscription.store');
    Route::get('subscription/{id}', 'AdminController@editSubscription')->name('subscription.edit');
    Route::put('subscription/{id}', 'AdminController@updateSubscription')->name('subscription.update');
    Route::delete('subscription/{id}', 'AdminController@deleteSubscription')->name('subscription.delete');

});