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

Route::domain('staff.'.ENV('APP_URL'))->group(function () {
    Auth::routes();
    Route::get('/', 'DashboardController@index')->name('dashboard.index')->middleware('guest');
    Route::get('home', 'DashboardController@home')->name('dashboard.home');
    Route::resource('resources', 'ResourceController')->except('show');
    Route::delete('photos/{photo}', 'PhotoController@destroy')->name('photos.destroy');
});

Route::get('/', function () {
    return view('frontend.welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('resources/{resource}', 'ResourceController@show')->name('resources.show');
