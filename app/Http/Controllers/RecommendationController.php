<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Recommendation;

class RecommendationController extends Controller
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
       return view('pages.dashboard');
   }


   public function getRecommendation(Request $request)
   {
    
    $aboveAverageMatch; 
    $averageMatch;


    //Array Variable to store recommendations - As it may contain more than one recommendation  
  //  $recommendation = 

    $user = User::all();
    $idealRecommendation = $user->where('');

    //Requests to the Recommendation Database Table
    $selectedGenre = $request['genre']; 
    $selectedWords = $request['words'];
    $selectedAgeRange = $request['ageRange'];
    $selectedLocation = $request['location'];;
    $selectionInstruments = $request['instruments'];
    $selectionSimilarity = $request['similarity'] ;

    //Create Recommondation
    $recommendation = new Recommendation();
    $recommendation->genre = $genre;
    $recommendation->words = $words;
    $recommendation->ageRange = $ageRange;
    $recommendation->location = $location;
    $recommendation->instruments = $instruments;
    $recommendation->similarity = $similarity;

    $recommendation->save();

    return view('pages.dashboard');

   }

    //function - IF .. like .. then they may like ... 
}
