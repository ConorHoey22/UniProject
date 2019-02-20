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
       
   }

}

?>