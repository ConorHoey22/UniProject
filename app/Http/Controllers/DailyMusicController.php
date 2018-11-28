<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;


use Auth;
use Cache;
use Session;
use View;


use Rennokki\Larafy\Larafy;
use Rennokki\Larafy\LarafySeed;




class DailyMusicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        $this->middleware('auth');


    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


//TEST2 


    //Test so  by default we want RandomUser only
    $randomUser = DB::table('users')
    ->inRandomOrder()
    ->where('userType','Band') //We need a variable to set which genre of music they release 
    ->take(1)
    ->get();

    $SetGenre = "";

//If activateSpotifyAPI == false
//return
//But we dont want to set it yet









 //IF user has not selected a Spotify Genre  - random user from DB and activation bool is passed to check 
     return view('pages.dailyMusic')->with('randomUser', $randomUser)->with('SetGenre' , $SetGenre);


    }
 

//TEST 1 Stack
    public function update(Request $request)
    {
        $SetGenre = $request->dailyMusicMatch;

        


      //  return redirect()->action('SpotifyController@index')->with('SetGenre' , $SetGenre);
      return redirect()->action('SpotifyController@SpotifyAPI', ['SetGenre' => $SetGenre]);
        
        
    }   
}