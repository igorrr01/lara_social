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
Auth::routes();
Route::group(['middleware' => 'guest'], function () {
Route::get('/register', 'UserController@create')->name('user.create');
Route::post('/register', 'UserController@store')->name('user.store');
Route::get('/login', 'UserController@loginForm')->name('login.create');
Route::post('/login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
Route::get('/', 'HomeController@index')->name('home');
Route::get('/fnews', 'HomeController@fnews')->name('fnews');
Route::get('/news', 'HomeController@news')->name('news');

Route::get('/tags/{tag}', 'HomeController@tags');
Route::post('user/search/', 'UserController@search')->name('search');

Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('post/create', 'PostController@create')->name('post.create');

Route::middleware('optimizeImages')->group(function () {
    // all images will be optimized automatically
Route::post('post/create', 'PostController@store')->name('post.store');

});




Route::post('post/comment/{id}', 'PostController@comment')->name('post.comment');
Route::get('post/view/{id}', 'PostController@view')->name('post.view');
Route::get('post/wholike/{id}', 'PostController@wholike')->name('post.wholike');
Route::get('post/delete/{id}', 'PostController@delete');
Route::get('post/deleteComment/{id}', 'PostController@deleteComment');
Route::get('user/block/{id}', 'UserController@block');
Route::get('/blocked', 'UserController@blocked');

Route::get('post/like/{id}', 'PostController@like')->name('post.like');
Route::get('user/{id}', 'UserController@show')->name('show_user');
Route::get('onlinelist', 'UserController@onlinelist')->name('onlinelist');
Route::get('userslist', 'UserController@userslist')->name('userslist');
Route::get('notify', 'UserController@notify')->name('notify');
Route::get('settings', 'UserController@settings')->name('settings');
Route::post('settings','UserController@changePassword')->name('changePassword');
Route::post('settings/change','UserController@changeAbout')->name('changeAbout');
Route::get('settings/change','UserController@changeAbout')->name('changeAbout');

Route::get('profile/avatar', 'UserController@avatar')->name('avatar');
Route::post('profile/avatar', 'UserController@avatarUpload')->name('avatar');

Route::get('user/follow/{profileId}', 'UserController@followUser')->name('user.follow');
Route::get('user/unfollow/{profileId}', 'UserController@unfollowUser')->name('user.unfollow');
Route::get('user/followings/{profileId}', 'UserController@followings')->name('user.followings');
Route::get('user/followers/{profileId}', 'UserController@followers')->name('user.followers');
});
// Password reset link request routes...
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/changePassword','UserController@showChangePasswordForm')->name('change.password');




