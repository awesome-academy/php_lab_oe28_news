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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@index')->name('indexLogin');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@index')->name('indexRegister');
    Route::post('/register', 'RegisterController@register')->name('register');
});

Route::get('/', 'HomeController@index')->name('home');

Route::resource('news', 'NewsController');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::group(['prefix' => 'news'], function() {
        Route::get('/', 'AdminController@indexNews')->name('adminNews');
        Route::get('/hot/{id}', 'AdminController@hotNews')->name('hotNews');
        Route::get('/{id}', 'AdminController@showNews')->name('adminShowNews');
        Route::get('/status/{id}/{statusId}', 'NewsController@status')->name('adminNewsStatus');
    });
});
