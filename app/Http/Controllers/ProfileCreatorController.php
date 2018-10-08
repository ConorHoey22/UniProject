<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ProfileCreatorController extends Controller
{


    use RegistersUsers;



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

        $genre_list = DB::table('genre')
        ->groupBy('genreName')
        ->get();
     
       return view('pages.createProfile')->with('genre_list',$genre_list);
    }

     
   

}

?>