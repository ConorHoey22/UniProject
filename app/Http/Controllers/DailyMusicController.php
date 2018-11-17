<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('pages.dailyMusic');
        

        
    }

    //public function spotifyProfileMatch()
    //{
        //$searchText = 'Ed Sheeran';


        //$FoundArtist = file_get_contents('https://api.spotify.com/v1/recommendations?limit=1&market=US&seed_genres=pop&max_tempo=180');
    //    
      //  return view('pages.dailyMusic')->with('FoundArtist',$FoundArtist);
  //  }

    public function randomProfileMatch()
    {
        //This find a random band , however we need now to based on the genre they want
        //Also limit this feature to every 24 hours

        //Unique artist or band
        //What if not unique
        //What if there are none of that genre or userType with that genre
        


        ////IF genre == rock
            //User Type match 
            //Genre match 
            //where userLikeGenre == musicianGenre

               //ElseIF genre == pop

               $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');    

        try 
        {
   
              $seed = (new LarafySeed)
              ->setGenres(['death-metal', 'hard-rock', 'black-metal']);
             // ->setTargetValence(90.3)
             // ->setSpeechiness(60.0, 90.0)
             // ->setLoudness(80.0, 100.0)
            //  ->setLiveness(80.0, 100.0);


           $limit = 1;
           $offset = 1;


            $result= $api->getRecommendations($seed, $limit);


            $result = json_decode(json_encode($result), true); //convert returned stdClass object into associative array
        } 
        catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e)
        {
            // invalid ID & Secret provided
            $e->getAPIResponse(); // Get the JSON API response.
        }








       $randomUser = DB::table('users')
                ->inRandomOrder()
                ->where('userType','Band') //We need a variable to set which genre of music they release 
                ->take(1)
                ->get();

     
                return view('pages.dailyMusic')->with('result', $result)->with('randomUser', $randomUser);

    }




}