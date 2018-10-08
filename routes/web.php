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
    return view('welcome');
});



Route::get('login', 'Auth\LoginController@index');
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();


/*Route::view('/homepage', 'pages.home');*/
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/createProfile','ProfileCreatorController@index');
Route::get('/createProfileCreate','ProfileCreatorController@create');
