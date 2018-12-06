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
        return view('pages.spotifyApi');
    }
    
    public function basicSearch()
    {
        //Get the requested genre selection from DailyMusic Controller
        $SetGenre = request()->get('SetGenre');
       
        //Try catch API Client Credtionals , This was used to users did not have to log into spotify to retrieve data
        try
        {
            $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');    
        }
        catch(\Exception $ex)
        {
            //IF the API can not be accessed
            return view('pages.errorSpotifyPage');
        }
        
        //Try catch for the genre query , Exceptions in an event the API cannot retrive data
        try 
        {
                //COmposer Larafy using its set methods
                $seed = (new LarafySeed)
                ->setGenres([$SetGenre]);//Using the dropdown value selection to generate an artist/band
              
                $limit = 1;//The amount of artists ands band , the user will receive 
                $offset = 1;// Set to one to ensure that the user can only receive one , This could be increase so between 1 and 5 artist but to ensure that it says at one 

                $result= $api->getRecommendations($seed, $limit); //$result used to store the data from the API

                $result = json_decode(json_encode($result), true); //convert returned stdClass object into associative array
            
        } 
        catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e)
        {
            // invalid ID & Secret provided 
            $e->getAPIResponse(); // Get the JSON API response.

            return view('pages.errorSpotifyPage');
        }


        //Exception handling  - If the user enter values in which result the API being unable to find data
        try 
        {
                //Spotify Artist/Band URL
                $SpotifyURL = $result[0]['album']['artists'][0]['external_urls']['spotify'];
                
                //Spotify Artist/Band Name
                $SpotifyName = $result[0]['album']['artists'][0]['name']; 

                //Spotify Artist/Band Image
                $SpotifyImage = $result[0]['album']['images'][0]['url'];

                //Spotify Artist/Band Album tracks
                $SpotifyAlbumView = $result[0]['album']['id'];

                //Returns variables to webpage
                return view('pages.spotifyApi')->with('result', $result)->with('setGenre',$SetGenre)->with('SpotifyName',$SpotifyName)->with('SpotifyURL' , $SpotifyURL)->with('SpotifyImage', $SpotifyImage)->with('SpotifyAlbumView' , $SpotifyAlbumView);

         
         } 
         catch(\Exception $ex) 
         {
             //Return user to error page
            return view('pages.errorSpotifyPage');
         }

    }


    public function advanceSearch()
    {
        //Get the requested genre selection from DailyMusic Controller
        $SetGenre = request()->get('SetGenre');
    
        //Get the requested instrumentalness min selection from DailyMusic Controller
        $instrumentalnessMin =  request()->get('instrumentalnessMin');
        
        //Get the requested instrumentalness max selection from DailyMusic Controller
        $instrumentalnessMax =  request()->get('instrumentalnessMax');

        //Get the requested liveness min selection from DailyMusic Controller
        $livenessMin =  request()->get('livenessMin');
      
        //Get the requested liveness max selection from DailyMusic Controller
        $livenessMax =  request()->get('livenessMax');

        //Try catch API Client Credtionals , This was used to users did not have to log into spotify to retrieve data
        try
        {
            $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');    
        }
        catch(\Exception $ex)
        {
            return view('pages.errorSpotifyPage');
        }

 
try
{
        if((empty($instrumentalnessMin) || empty($instrumentalnessMax)) && (empty($livenessMin) || empty($livenessMax) && !empty($SetGenre)))
        {
           
             $seed = (new LarafySeed)
            ->setGenres([$SetGenre]);
          echo "3";

      
        }   
        elseif((empty($instrumentalnessMin) || empty($instrumentalnessMax)) && (!empty($SetGenre) && !empty($livenessMin) && !empty($livenessMax))) // try === 
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setLiveness($livenessMin,$livenessMax);
          echo "1";
        }
        elseif((empty($livenessMin) || empty($livenessMax)) && (!empty($SetGenre) && !empty($instrumentalnessMin)) && (!empty($instrumentalnessMax)))
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setInstrumentalness($instrumentalnessMin,$instrumentalnessMax);
           echo "2";
        }
        
        else
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setInstrumentalness($instrumentalnessMin,$instrumentalnessMax)
            ->setLiveness($livenessMin,$livenessMax);
         echo "4";
        }

        $limit = 1;
        $offset = 1;

        $result= $api->getRecommendations($seed, $limit);

        $result = json_decode(json_encode($result), true); //convert returned stdClass object into associative array

        



}
    catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e)
    {
    // invalid ID & Secret provided 
    return view('pages.errorSpotifyPage');
    $e->getAPIResponse(); // Get the JSON API response.

    }





    
    
   



            //Exception handling  - If the user enter values in which result the API being unable to find data
            try {

                $SpotifyURL = $result[0]['album']['artists'][0]['external_urls']['spotify'];
    
                $SpotifyName = $result[0]['album']['artists'][0]['name']; 
    
                $SpotifyImage = $result[0]['album']['images'][0]['url'];
    
                $SpotifyFollowBtn = $result[0]['album']['artists'][0]['uri'];
    
                $SpotifyAlbumView = $result[0]['album']['id'];
    
                return view('pages.spotifyApi')->with('result', $result)->with('SpotifyName',$SpotifyName)->with('SpotifyURL' , $SpotifyURL)->with('SpotifyImage', $SpotifyImage)->with('SpotifyAlbumView' , $SpotifyAlbumView);
    
    
                } 
                catch(\Exception $ex) 
                {
                //Return user to error page
                return view('pages.errorSpotifyPage');
                }
    
    
    }
    

        
    }