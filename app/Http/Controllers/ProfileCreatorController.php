<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProfileCreatorController extends Controller
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
       
        /* Genres Dropdown  - This creates a list from the Database table called musicgenres which store genres*/

        $genre_list = DB::table('musicgenres')
        ->groupBy('genre')
        ->get();

        return view('pages.createProfile')->with('genre_list', $genre_list);
    }
}

?>