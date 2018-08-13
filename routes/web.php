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

Route::get('/', 'PagesController@index')->name('index');

Route::resources([
    'members' => 'MembersController'
]);

Route::get('/member/{member}/async_edit', 'MembersController@asyncEdit');

Route::post('/members/{member}/loans', 'LoansController@store');
Route::get('/par_report', 'LoansController@showPARReport')->name('par_report.index');
Route::get('/par_report/get_data', 'LoansController@getPARData')->name('par_report.get_data');
Route::get('//loans/{loan}/edit', 'LoansController@edit')->name('loans.edit');
Route::post('/loans/{loan}', 'LoansController@update');

Route::post('/loans/{loan}/payments', 'PaymentsController@store');
Route::delete('/payments/{payment}', 'PaymentsController@destroy');
Route::get('/payments/{payment}/async_edit', 'PaymentsController@asyncEdit');
Route::post('/payments/{payment}', 'PaymentsController@update');

Route::get('database/dump', 'DatabaseController@dump')->name('database.dump');
