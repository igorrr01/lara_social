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

Route::group(['middleware' => 'guest'], function () {
Route::get('/register', 'UserController@create')->name('user.create');
Route::post('/register', 'UserController@store')->name('user.store');
Route::get('/login', 'UserController@loginForm')->name('login.create');
Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post/create', 'PostController@store')->name('post.store');

Route::get('post/like/{id}', 'PostController@like')->name('post.like');
Route::get('user/{id}', 'UserController@show')->name('show_user');
Route::get('profile/avatar', 'UserController@avatar')->name('avatar');
Route::post('profile/avatar', 'UserController@avatarUpload')->name('avatar');
