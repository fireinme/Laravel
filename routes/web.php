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

Route::get('/', 'StaticPageController@home')->name('home');
Route::get('/help', 'StaticPageController@help')->name('help');
Route::get('/about', 'StaticPageController@about')->name('about');
//注册
Route::get('/signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
//登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');