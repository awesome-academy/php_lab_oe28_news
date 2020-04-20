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

Route::get('/search', 'HomeController@search')->name('search');

Route::get('/{slug}', 'HomeController@category')->name('category');

Route::resource('news', 'NewsController');

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function() {
    Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
        Route::get('/search', 'AdminController@searchNews')->name('search');
        Route::get('/category/{id}', 'AdminController@category')->name('category');
        Route::get('/', 'AdminController@indexNews')->name('index');
        Route::get('/hot/{id}', 'AdminController@hotNews')->name('hot');
        Route::get('/{id}', 'AdminController@showNews')->name('show');
        Route::get('/status/{id}/{statusId}', 'NewsController@status')->name('status');
    });
});
