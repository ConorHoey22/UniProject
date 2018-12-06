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

   //Checks authorisation and if the user of the website is logged in. User will be redirected if not
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

        $SetGenre = "";
         $instrumentalnessMin = "";
      $instrumentalnessMax = "";
  
         return view('pages.dailyMusic')->with('SetGenre' , $SetGenre , 'instrumentalnessMin' , $instrumentalnessMin , 'instrumentalnessMax' , $instrumentalnessMax);
    }
 


    public function basicSearchUpdate(Request $request)
    {
        //Return String value from dropdown
        $SetGenre = $request->genreList;

        //redirect user to another controller function with the dropdown selection 
        return redirect()->action('SpotifyController@basicSearch', ['SetGenre' => $SetGenre]);
    
    }   

    public function advancedSearchUpdate(Request $request)
    {
     
    //Returns values from Dropdown

      //Return String value 
      $SetGenre = $request->advancedGenreList;

      //Return Float values
      $instrumentalnessMin = $request->instrumentalnessMin;
      $instrumentalnessMax = $request->instrumentalnessMax;

      //Return Float values
      $livenessMin = $request->livenessMin;
      $livenessMax = $request->livenessMax;

        

     //redirect user to another controller function with the dropdown selection 
     return redirect()->action('SpotifyController@advanceSearch', ['SetGenre' => $SetGenre , 'instrumentalnessMin' => $instrumentalnessMin , 'instrumentalnessMax' => $instrumentalnessMax , 'livenessMin' => $livenessMin , 'livenessMax' => $livenessMax]);
                
    }   
}