# UniProject

This is my final year project which is a Music social media website using HTML , CSS , PHP ,MYSQL and Laravel PHP. 
The aim of this website is to allow users to discover new music artists and bands and also artists and bands can use this platform to promote themselves. This website also contains a function which allows the users to request data from the Spotify API which is then displayed using spotify widgets.(Custom Spotify Recommendation System).

Functions of the website:

- User Registeration and Login System
- User Following System
- User Recommendation System
- Custom Spotify Recommendation System
- User Profiles pages
- Edit & Delete Profile Details
- Users Posts 
- Edit & Delete Posts




UserController contains all functions of the website 
PostController handles user posts 

A user can register, login , create a post , edit a post , follow another user , unfollow , view other users profiles. 

Note - There are some unused files but these ater for future developments

# Spotify API - Advanced Recommendation System  (SpotifyController.php)
This project utilied Larafy ( https://github.com/rennokki/larafy ) which  is a PHP API Wrapper for Spotify API. This wrapper is more oriented over Spotifys Client Credentials authenticated endpoints. This was just an addition feature of my uni assignment.
```
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
                $offset = 1;// Set to one to ensure that the user can only receive one 
                , This could be increase so between 1 and 5 artist but to ensure that it says at one 
                
                $result= $api->getRecommendations($seed, $limit); //$result used to store the data from the API
                $result = json_decode(json_encode($result), true); //convert returned stdClass object into associative array
            
        } 
        catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e)
        {
            // invalid ID & Secret provided 
            $e->getAPIResponse(); // Get the JSON API response.
            return view('pages.errorSpotifyPage');
        }
        //Stores and retrieves specific data from the data sent by the API
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
                return view('pages.spotifyApi')
                ->with('result', $result)
                ->with('setGenre',$SetGenre)
                ->with('SpotifyName',$SpotifyName)
                ->with('SpotifyURL' , $SpotifyURL)
                ->with('SpotifyImage', $SpotifyImage)
                ->with('SpotifyAlbumView' , $SpotifyAlbumView);
         
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
        
    //User Validation
    try
    { 
    //User does not select a InstrumentalnessMin or Max value AND does not select LivenessMin or Max value but selects a genre 
      if((empty($instrumentalnessMin) || empty($instrumentalnessMax)) && (empty($livenessMin) || empty($livenessMax) && !empty($SetGenre)))
        {
           //NOTE : Genre is made required within the HTML form dropdown
             $seed = (new LarafySeed)
            ->setGenres([$SetGenre]);
          
      
        }   
        //User does not select a InstrumentalnessMin or Max value AND selects a genre and livenessMin and max values  
        elseif((empty($instrumentalnessMin) || empty($instrumentalnessMax)) && (!empty($SetGenre) && !empty($livenessMin) && !empty($livenessMax))) // try === 
        {
            
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setLiveness($livenessMin,$livenessMax);
           
          
        }
        //User does not select a livenessMin or Max value AND selects a genre and instrumentalMin and max values  
        elseif((empty($livenessMin) || empty($livenessMax)) && (!empty($SetGenre) && !empty($instrumentalnessMin)) && (!empty($instrumentalnessMax)))
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setInstrumentalness($instrumentalnessMin,$instrumentalnessMax);
           
        }
        
        else
        {
            $seed = (new LarafySeed)
            ->setGenres([$SetGenre])
            ->setInstrumentalness($instrumentalnessMin,$instrumentalnessMax)
            ->setLiveness($livenessMin,$livenessMax);
        
        }
        $limit = 1;//The amount of artists ands band , the user will receive 
        $offset = 1;// Set to one to ensure that the user can only receive one , T
        his could be increase so between 1 and 5 artist but to ensure that it says at one 
        
        $result= $api->getRecommendations($seed, $limit); //$result used to store the data from the API
        $result = json_decode(json_encode($result), true); //convert returned stdClass object into associative array
    }
    catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e)
    {
        // invalid ID & Secret provided 
        return view('pages.errorSpotifyPage');
        $e->getAPIResponse(); // Get the JSON API response.
    }
            //Stores and retrieves specific data from the data sent by the API
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
                    
                //Returns to display webpage
                return view('pages.spotifyApi')
                ->with('result', $result)
                ->with('SpotifyName',$SpotifyName)
                ->with('SpotifyURL' , $SpotifyURL)
                ->with('SpotifyImage', $SpotifyImage)
                ->with('SpotifyAlbumView' , $SpotifyAlbumView);
    
            } 
            catch(\Exception $ex) 
            {
                //Return user to error page
                return view('pages.errorSpotifyPage');
            }
    
       }
    
    }
    ```


Files
 
# Registeration System
  Description
  Files
  Frontend
  
# Login System
  Description
  Files
  Frontend
  
  
  
  
