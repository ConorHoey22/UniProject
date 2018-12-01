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
    

    public function basicSearch()
    {
        $SetGenre = request()->get('SetGenre');

    //    $instrumentalnessMin  = 0.7;
      //  $instrumentalnessMax = 1.0;
       

        
        $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');    

        try 
        {

        



                $seed = (new LarafySeed)
                ->setGenres([$SetGenre]);
               // ->setAcousticness($acousticnessMin , $acousticnessMax );
                // ->setTargetValence(90.3)
                // ->setSpeechiness(60.0, 90.0)
                 //->setLoudness(90.0 , 100.0);
                 //->setLiveness(80.0, 100.0);
                //->setInstrumentalness(0.9 , 1.0);
               // ->setInstrumentalness($instrumentalnessMin , $instrumentalnessMax);


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


       



        //Exception handling  - If the user enter values in which result the API being unable to find data
        try {

                $SpotifyURL = $result[0]['album']['artists'][0]['external_urls']['spotify'];

                $SpotifyName = $result[0]['album']['artists'][0]['name']; 

                $SpotifyImage = $result[0]['album']['images'][0]['url'];

                $SpotifyFollowBtn = $result[0]['album']['artists'][0]['uri'];

                $SpotifyAlbumView = $result[0]['album']['id'];

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

        $SetGenre = request()->get('SetGenre');
    
        $instrumentalnessMin =  request()->get('instrumentalnessMin');
        //WHAT IF THEY ARE EMPTY CAN YOU STILL GET
        $instrumentalnessMax =  request()->get('instrumentalnessMax');

        $livenessMin =  request()->get('livenessMin');
        //WHAT IF THEY ARE EMPTY CAN YOU STILL GET
        $livenessMax =  request()->get('livenessMax');

    $api = new Larafy('24974f52d3fc4029a03bee338698b062', 'a3cffe10627f44daafb8b7fe91d536dd');// need to somewhere




 

    //Validation
   try
    {
        if((empty($instrumentalnessMin) || (empty($instrumentalnessMax) && (empty($livenessMin) || empty($livenessMax) && !empty($SetGenre)))))
        {
           
             $seed = (new LarafySeed)
            ->setGenres([$SetGenre]);

          echo "3";
        }   
        elseif(empty($instrumentalnessMin) || (empty($instrumentalnessMax) && (!empty($SetGenre)))) // try === 
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setLiveness($livenessMin,$livenessMax);
          echo "1";

        }
        elseif(empty($livenessMin) || (empty($livenessMax) && (!empty($SetGenre))))
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