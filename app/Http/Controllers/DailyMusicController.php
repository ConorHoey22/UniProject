<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    public function randomProfileMatch()
    {
        //This find a random band , however we need now to based on the genre they want
        //Also limit this feature to every 24 hours

        $randomUser = DB::table('users')
                 ->inRandomOrder()
                 ->where('userType','Band')
                 ->take(1)
                 ->get();

        


        return view('pages.dailyMusic')->with('randomUser',$randomUser);


    }




}