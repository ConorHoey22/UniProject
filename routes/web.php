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
        return view('pages.welcome');
    });
    
 
    Route::post('/signup','UserController@postSignUp')->name('postsignup');
    
    Route::post('/signin','UserController@postSignIn')->name('signinUser');

Route::post('/createPost', 'UserController@createPost')->name('createPost');

Route::post('/createRecommendation', 'UserController@createRecommendation')->name('createRecommendation');

//Route::get('/userProfile', 'UserController@index')->name('profile');
//Route::get('/deletePost', 'PostsController@getDelete')->name('postDelete');

//Route::get('/deletePost/{postID}', 'PostsController@getDelete')->name('delPost');



Route::get('/profile/{id}', [
    'uses' => 'UserController@show',
    'as' => 'user.profile',
    'middleware' => 'auth'
]);

Route::get('/MyProfile', [
    'uses' => 'UserController@index',
    'as' => 'MyProfile',
    'middleware' => 'auth'
]);


Route::get('/updatePost', [
    'uses' => 'UserController@updatePost',
    'as' => 'updatePost',
    'middleware' => 'auth'
]);


Route::get('/delete-post/{post_id}', [
    'uses' => 'UserController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);


Route::get('/MyRecommendation', [
    'uses' => 'UserController@insertRecommendation',
    'as' => 'MyRecommendation',
    'middleware' => 'auth'
]);

Route::get('/MyDashboard', [
    'uses' => 'UserController@MyDashboard',
    'as' => 'MyDashboard',
    'middleware' => 'auth'
]);





//Auth Routes
Route::get('login', 'Auth\LoginController@index');
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();


//Profile Webpages Routes 
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/createProfile','ProfileCreatorController@index');
Route::get('/createProfileCreate','ProfileCreatorController@create');
Route::get('/editProfile','EditProfileController@index');



//Controller routes to retrieve and send data to and from Spotify API 
Route::get('/dailyMusicRandomMatch','DailyMusicController@randomMatch');
Route::post('/basicSearchUpdate', 'DailyMusicController@basicSearchUpdate');
Route::post('/advancedSearchUpdate', 'DailyMusicController@advancedSearchUpdate');
Route::get('/dailyMusic','DailyMusicController@index');



//Controllers Routes which direct the to a specific function
Route::get('/basicSearch','SpotifyController@basicSearch');
Route::get('/advancedSearch','SpotifyController@advanceSearch');

?>

