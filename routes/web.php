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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    //default auth route
    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Users
     */
    Route::any('user/search', 'UserController@search');
    Route::get('user/auth', 'UserController@getUserAuth');
    Route::resource('user', 'UserController');

    /**
     * Chat
     */
    Route::any('chat/search', 'ChatController@search');
    Route::resource('chat', 'ChatController');
});
