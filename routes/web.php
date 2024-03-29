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

Route::get('/', function () {
    return view('homepage');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

# Destinations
Route::get('destinations', 'DestinationsController@index');

# Blog
Route::get('vs-blog', 'BlogController@index');
Route::get('vs-blog/{url}', 'BlogController@singlePost');

Route::group([ 'prefix' => 'auth', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::resource('blog', 'BlogController');
    Route::resource('category', 'CategoryController');
    Route::resource('location', 'LocationController');
});

