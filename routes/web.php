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


Route::get('profile', 'UserController@profile');

Route::post('upload_image', 'UserController@update_image')->name('upload_image');


Route::post('upload', 'UploadController@upload');

//Update User Details Routes----------------------------------------------------------------------------------------------
Route::post('/updateUsername','UserController@updateUsername')->name('updateUsername');
Route::post('/updateEmail','UserController@updateEmail')->name('updateEmail');
Route::post('/updatePassword','UserController@updatePassword')->name('updatePassword');

Route::post('/updateAgeRange','UserController@updateAgeRange')->name('updateAgeRange');
Route::post('/updateAge','UserController@updateAge')->name('updateAge');
Route::post('/updateCountry','UserController@updateCountry')->name('updateCountry');
Route::post('/updateLocation','UserController@updateLocation')->name('updateLocation');
Route::post('/updateUserType','UserController@updateUserType')->name('updateUserType');
Route::post('/updateGenre','UserController@updateGenre')->name('updateGenre');
Route::post('/updateDescription','UserController@updateDescription')->name('updateDescription');

Route::post('/updateSoundCloudWidget','UserController@updateSoundCloudWidget')->name('updateSoundCloudWidget');
Route::post('/updateSoundCLoudProfile','UserController@updateSoundCloudProfile')->name('updateSoundCloudProfile');
Route::post('/updateSpotify','UserController@updateSpotify')->name('updateSpotify');

Route::post('/updateWord1','UserController@updateWord1')->name('updateWord1');
Route::post('/updateWord2','UserController@updateWord2')->name('updateWord2');
Route::post('/updateWord3','UserController@updateWord3')->name('updateWord3');
Route::post('/updateWord4','UserController@updateWord4')->name('updateWord4');
Route::post('/updateWord5','UserController@updateWord5')->name('updateWord5');


Route::post('/updateSimilarity','UserController@updateSimilarity')->name('updateSimilarity');
Route::post('/updateInstruments','UserController@updateInstruments')->name('updateInstruments');
//-------------------------------------------------------------------------------------------------------------------



//Update Recommendation Details Routes----------------------------------------------------------------------------------------------
Route::post('/updateRecommendationAgeRange','UserController@updateRecommendationAgeRange')->name('updateRecommendationAgeRange');
Route::post('/updateRecommendationAge','UserController@updateRecommendationAge')->name('updateRecommendationAge');
Route::post('/updateRecommendationCountry','UserController@updateRecommendationCountry')->name('updateRecommendationCountry');
Route::post('/updateRecommendationLocation','UserController@updateRecommendationLocation')->name('updateRecommendationLocation');
Route::post('/updateRecommendationUserType','UserController@updateRecommendationUserType')->name('updateRecommendationUserType');
Route::post('/updateRecommendationGenre','UserController@updateRecommendationGenre')->name('updateRecommendationGenre');
Route::post('/updateRecommendationWord1','UserController@updateRecommendationWord1')->name('updateRecommendationWord1');
Route::post('/updateRecommendationWord2','UserController@updateRecommendationWord2')->name('updateRecommendationWord2');
Route::post('/updateRecommendationWord3','UserController@updateRecommendationWord3')->name('updateRecommendationWord3');
Route::post('/updateRecommendationWord4','UserController@updateRecommendationWord4')->name('updateRecommendationWord4');
Route::post('/updateRecommendationWord5','UserController@updateRecommendationWord5')->name('updateRecommendationWord5');

Route::post('/updateRecommendationSimilarity','UserController@updateRecommendationSimilarity')->name('updateRecommendationSimilarity');
Route::post('/updateRecommendationInstruments','UserController@updateRecommendationInstruments')->name('updateRecommendationInstruments');
//-------------------------------------------------------------------------------------------------------------------


Route::get('/followFunction/{id}', [
    'uses' => 'UserController@followFunction',
    'as' => 'user.follow',
    'middleware' => 'auth'
]);



Route::get('/unfollowFunction/{id}', [
    'uses' => 'UserController@unfollowFunction',
    'as' => 'user.unfollow',
    'middleware' => 'auth'
]);




Route::get('/profile/{username}', [
    'uses' => 'UserController@show',
    'as' => 'user.profile',
    'middleware' => 'auth'
]);

Route::get('/MyProfile', [
    'uses' => 'UserController@index',
    'as' => 'MyProfile',
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

