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


class SpotifyController extends Controller
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


      
        return view('pages.spotifyApi');

    }

     
//return view('pages.spotifyApi')->with('setGenre', $SetGenre1);
    

    public function SpotifyAPI()
    {
        $SetGenre = request()->get('SetGenre');







        
        $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');    

        try 
        {
   
                $seed = (new LarafySeed)
                ->setGenres([$SetGenre]);
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

        $SpotifyURL = $result[0]['album']['artists'][0]['external_urls']['spotify'] . "\r\n";

        $SpotifyName = $result[0]['album']['artists'][0]['name']; 

        $SpotifyImage = $result[0]['album']['images'][0]['url'];

        $SpotifyFollowBtn = $result[0]['album']['artists'][0]['uri'];

        $SpotifyAlbumView = $result[0]['album']['id'];



        return view('pages.spotifyApi')->with('result', $result)->with('randomUser', $randomUser)->with('setGenre',$SetGenre)->with('SpotifyName',$SpotifyName)->with('SpotifyURL' , $SpotifyURL)->with('SpotifyImage', $SpotifyImage)->with('SpotifyFollowBtn' , $SpotifyFollowBtn)->with('SpotifyAlbumView' , $SpotifyAlbumView);
     //   ->with('SpotifyFollowBtn' , $SpotifyFollowBtn);
       }
}

