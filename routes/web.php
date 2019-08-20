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

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/transfer/balance', 'TransfersController@balance')->name('transfer.balance');
Route::post('/transfer/balance/store', 'TransfersController@balance_store')->name('transfer.balance.store');

Route::get('/transfer/plan', 'TransfersController@plan')->name('transfer.plan');
Route::post('/transfer/plan/store', 'TransfersController@plan_store')->name('transfer.plan.store');

Route::get('/transfer/send/{id}', 'TransfersController@send_transfer')->name('transfer.send');

Route::get('/transfer/users/list', 'TransfersController@users')->name('transfer.users.list');

