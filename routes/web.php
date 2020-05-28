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
Route::resource('categories', 'CategoryController');

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function() {
    Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
        Route::get('/search', 'AdminController@searchNews')->name('search');
        Route::get('/category/{id}', 'AdminController@category')->name('category');
        Route::get('/', 'AdminController@indexNews')->name('index');
        Route::get('/hot/{id}', 'AdminController@hotNews')->name('hot');
        Route::get('/{id}', 'AdminController@showNews')->name('show');
        Route::get('/status/{id}/{statusId}', 'NewsController@status')->name('status');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', 'AdminController@indexCategories')->name('index');
        Route::get('/{id}', 'AdminController@editCategory')->name('edit');
    });

    Route::get('/chart', 'AdminController@chart')->name('chart');
});


Route::group(['prefix' => 'user', 'middleware' => 'auth', 'as' => 'user.'], function () {
    Route::post('/update', 'UserController@updateProfile')->name('update');
    Route::get('/{username}', 'UserController@profile')->name('profile');
    Route::post('/like', 'UserController@handleLike')->name('like');
    Route::post('/comment/{slug}', 'UserController@comment')->name('comment');
    Route::post('/comment', 'UserController@deleteComment')->name('deleteComment');
});

Route::group(['prefix' => 'review', 'middleware' => 'review', 'as' => 'review.'], function () {
    Route::get('/search', 'ReviewController@searchNews')->name('search');
    Route::get('/index', 'ReviewController@index')->name('index');
    Route::get('/status/{id}/{statusId}', 'NewsController@status')->name('status');
    Route::get('/category/{id}', 'ReviewController@category')->name('category');
    Route::get('/{id}', 'ReviewController@editNews')->name('news');
    Route::get('/notification/{id}', 'ReviewController@readNotification')->name('notification');
});

Route::group(['prefix' => 'write', 'middleware' => 'write', 'as' => 'write.'], function () {
    Route::get('/search', 'WriteController@searchNews')->name('search');
    Route::get('/create', 'WriteController@createNews')->name('createNews');
    Route::get('/index', 'WriteController@index')->name('index');
    Route::get('/status/{id}/{statusId}', 'NewsController@status')->name('status');
    Route::get('/category/{id}', 'WriteController@category')->name('category');
    Route::get('/{id}', 'WriteController@editNews')->name('news');
    Route::post('/photo', 'WriteController@photo')->name('photo');
});
