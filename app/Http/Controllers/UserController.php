<?php


namespace App\Http\Controllers;


use App\Posts;
use App\Recommendation;
use App\User;
use App\Follower;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Auth;

use DB;


class UserController extends Controller
{
    public function index()
    {
    
    //Return user to the requested user profile

    //$posts = DB::table('posts')->where('id', auth()->id())->get();

    $posts = \Auth::user()->posts()->get();


    $user = Auth::user();


    $AuthSoundCloudWidget = Auth::user()->soundCloudWidget;

    $AuthSoundCloudProfile = Auth::user()->soundCloudProfile;

    $AuthSpotifyProfile = Auth::user()->spotifyProfile;



    return view('pages.myProfile')->with('posts', $posts )->with('AuthSoundCloudWidget', $AuthSoundCloudWidget)->with('AuthSoundCloudProfile', $AuthSoundCloudProfile)->with('user', $user) ->with('AuthSpotifyProfile', $AuthSpotifyProfile);



    
    }



    public function show(Request $request, $username)
    {
    

        

        //Store and Find the user ID which then used to retrieve their profile - E.g. www._____.com/profile/1
       // $user = User::find($username);


       $user = User::where('username', $username)->first();
        if($user == null)
        {
            //User cannot be found - Return user to Error Message page explaining the problem

            $message = "The user profile that you previously tried to retrieve does not exist!";

            return redirect()->route('dashboard')->with('message', $message);
           
        }
        else
        {

            //Return user to the requested user profile

            $posts = $user->posts()->get();
            



            return view('pages.profile')->with('user' , $user)->with('posts', $posts );
        }

       
    }


    public function followFunction(Request $request, $id)
    {
     $user= User::find($id);
    



        // User Validation - You can't follow a user that you already follow.
        if(Follower::where('follower_id','=', Auth::id())->where('user_id','=',$request['id'])->exists())
        {
            $message = "You are already following this user!";

            return back()->with('message', $message);
        }
        //User Validation - The logged in User can't follow themselves (BUG NOT Working) 
        elseif(Follower::where('follower_id','=', Auth::id())->where('user_id','=',Auth::id())->exists())
        {
            $message = "You can't follow yourself!";

            return back()->with('message', $message);
        } 
        //Success Statement - Follow User
        else
        {
            DB::table('follower')->insert(
            ['follower_id' => Auth::id(), 'user_id' => $request['id']]
            );
        
            $message = "Success - Following";

            return back()->with('message' , $message);
        }   


    }








    public function update_image(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $imageName = $user->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();

        $request->image->storeAs('images',$imageName);

        $user->image = $imageName;
        $user->save();

        return back()
            ->with('success','You have updated image.');


            //NEED VALIDATION FOR invalid formats

    }



        
    public function updatePost(Request $request, Posts $post)
    {

        $postUpdate = Post::where('id' , $post->id)->update(['postTitle' => $request->input('postTitle'), 'postContent' => $request->input('postContent')]);


        if($postUpdate)
        {
            return redirect()->route('MyProfile', ['post'=>$post->id])->with('success');
        }






            return back()->withInput();




     
        
    }





    public function createPost(Request $request)
    {
        //valdation
        $this->validate($request, [
            'postTitle' => 'required|max:30',
            'postContent' => 'required|max:50'
        ]);



        $posts = new Posts();
        $posts->postTitle = $request['postTitle'];
        $posts->postContent = $request['postContent'];  
        $request->user()->posts()->save($posts);

        $message = "Error - You must fill in the post title and content!";

         if($request->user()->posts()->save($posts))
         {
            $message = "Success - Post has been added";
         }

         return redirect()->route('MyProfile')->with('message', $message);
    }

    public function getDeletePost($post_id)
    {
        $posts = Posts::where('id', $post_id)->first();
        if (Auth::user() != $posts->user) {
            return redirect()->back();
        }
        $posts->delete();
        return redirect()->route('MyProfile')->with(['message' => 'Successfully deleted!']);
    }



    public function postSignUp(Request $request)
    {
        //User Validation - Prevent users from ..
        //email not empty
        $this->validate($request,[
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'ageRange' => 'nullable|string|max:255',
            'userAge' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'userType' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'profileDescription' => 'nullable|string|max:255',
            'soundCloudWidget' => 'nullable|string|max:255',
            'soundCloudProfile' => 'nullable|string|max:255',
            'spotifyProfile' => 'nullable|string|max:255',
            'word1' => 'nullable|string|max:255',
            'word2' => 'nullable|string|max:255',
            'word3' => 'nullable|string|max:255',
            'word4' => 'nullable|string|max:255',
            'word5' => 'nullable|string|max:255',
            'similarity' => 'nullable|string|max:255',
            'instruments' => 'nullable|string|max:255',
            'recommendationGenre' => 'required|string|max:255',
            'recommendationWord1' => 'required|string|max:255',
            'recommendationWord2' => 'required|string|max:255',
            'recommendationWord3' => 'required|string|max:255',
            'recommendationWord4' => 'required|string|max:255',
            'recommendationWord5' => 'required|string|max:255',
            'recommendationAge' => 'required|string|max:255',
            'recommendationLocation' => 'required|string|max:255',
            'recommendationInstruments' => 'required|string|max:255',
            'recommendationSimilarity' => 'required|string|max:255',
            'recommendationUserType' => 'required|string|max:255',
            
        ]);

        //Requests 
        $username = $request['username'];
        $email= $request['email'];
        $password = bcrypt( $request['password']);
        $ageRange = $request['ageRange'];
        $userAge = $request['userAge'];
        $country = $request['country'];
        $location = $request['location'];
        $userType = $request['userType'];
        $genre = $request['genre'];
        $profileDescription= $request['profileDescription'];
        $soundCloudWidget = $request['soundCloudWidget'];
        $soundCloudProfile = $request['soundCloudProfile'];
        $spotifyProfile = $request['spotifyProfile'];
        $word1 = $request['word1'];
        $word2 = $request['word2'];
        $word3 = $request['word3'];
        $word4 = $request['word4'];
        $word5 = $request['word5'];
        $similarity = $request['similarity'];
        $instruments = $request['instruments'];
        //Recommendation
        $recommendationGenre = $request['recommendationGenre'];
        $recommendationWord1 = $request['recommendationWord1'];
        $recommendationWord2 = $request['recommendationWord2'];
        $recommendationWord3 = $request['recommendationWord3'];
        $recommendationWord4 = $request['recommendationWord4'];
        $recommendationWord5 = $request['recommendationWord5'];
        $recommendationAge = $request['recommendationAge'];
        $recommendationLocation = $request['recommendationLocation'];    
        $recommendationInstruments = $request['recommendationInstruments'];
        $recommendationSimilarity = $request['recommendationSimilarity'];
        $recommendationUserType = $request['recommendationUserType'];


       

        //Create User
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->ageRange = $ageRange;
        $user->userAge = $userAge;
        $user->country = $country;
        $user->location = $location;
        $user->userType = $userType;
        $user->genre = $genre;
        $user->profileDescription = $profileDescription;
        $user->soundCloudWidget = $soundCloudWidget;
        $user->soundCloudProfile = $soundCloudProfile;
        $user->spotifyProfile = $spotifyProfile;
        $user->word1 = $word1;
        $user->word2 = $word2;
        $user->word3 = $word3;
        $user->word4 = $word4;
        $user->word5 = $word5;
        $user->similarity = $similarity;
        $user->instruments = $instruments;
        //Create User Recommendation
        $user->recommendationGenre = $recommendationGenre;
        $user->recommendationWord1 = $recommendationWord1;
        $user->recommendationWord2 = $recommendationWord2;
        $user->recommendationWord3 = $recommendationWord3;
        $user->recommendationWord4 = $recommendationWord4;
        $user->recommendationWord5 = $recommendationWord5;
        $user->recommendationAge = $recommendationAge;
        $user->recommendationLocation = $recommendationLocation;
        $user->recommendationInstruments = $recommendationInstruments;
        $user->recommendationSimilarity = $recommendationSimilarity;
        $user->recommendationUserType= $recommendationUserType;
        
      

        $user->save();
        
        Auth::login($user);
        
        //Redirect to Auth Dashboard
        return redirect()->route('MyDashboard');

    }

    public function postSignIn(Request $request)
    {

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            //redirect users to dashboard
            return redirect()->route('MyDashboard');
        }
        else
        {
            //redirect users to Login view
            return view('auth.login');
        }

    }

      //Logout function -  the current user
      public function logout(Request $request)
      {
            Auth::logout();
           
            //redirect users to Login view
            return view('auth.login');
      }



    
   
   
      public function MyDashboard()
      {
        //every user has a dashboard but only they can view it

        //Exact Match Query - This is when all recommendation conditions are matched with another user 

      //Thats working  - Recommendation  Match 
    /*  $recommendationExact = DB::table('users')
            ->select('username')
            ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details *Required*
            ->where('genre', '=' , Auth::user()->recommendationGenre) // This is a required where clause for all statements  *Required*
            ->where('userType', '=' , Auth::user()->recommendationUserType) // Find the userType they have requested *Required*
            ->where('location', '=' , Auth::user()->recommendationLocation)  //Find  thej location of the Artist/Band , they have requested *Required*
            ->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
            ->whereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
            ->whereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
            ->whereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
            ->whereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
            ->paginate(2);
            */
          


















//Recommendated UserType , Genre 
$recommendationAvgMatch = DB::table('users')
            ->select('username')
            ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details *Required*
            ->where('genre', '=' , Auth::user()->recommendationGenre) // This is a required where clause for all statements  *Required*
            ->where('userType', '=' , Auth::user()->recommendationUserType) // Find the userType they have requested *Required*
            ->paginate(2);
//Recommendated UserTy



//WOrking

//Recommendation System – currently it looks at all 5 of the users recommendation words 
//and find all the users with at least one of those words(they have enter that describes their band or themselves)


//Artist match based on Words
//$recommendationWordsQuery=  User::where('id', '<>', Auth::user()->id)
//->select('username' , 'location')
//->where('userType', '=' , 'Artist') // Find the userType they have requested *Required*



$recommendationArtistWordsQuery= DB::table('users')

->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details *Required*
->where('userType', '=' , 'Artist') // Find the userType they have requested *Required*

->where(function ($query) {
    $query->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word5', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5]);
}) 
->paginate(5); // NEED TO DETERMINE HOW MANY USERS WILL BE RETURNED
//->paginate(6);



//Band match based on Words
$recommendationBandWordsQuery=  User::where('id', '<>', Auth::user()->id)

->where('userType', '=' , 'Band') // Find the userType they have requested *Required*
->where(function ($query) {
    $query->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
          ->orWhereIn('word5', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5]);
}) 
->paginate(5); // NEED TO DETERMINE HOW MANY USERS WILL BE RETURNED








 // THIS IS USERTYPE = Artist,GENRE,WORDS Query (Working) // BASED ON WORDS
 $recommendationArtistQuery=  User::where('id', '<>', Auth::user()->id)

 ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details *Required*
 ->where('genre', '=' , Auth::user()->recommendationGenre) // This is a required where clause for all statements  *Required*
 ->where('userType', '=' , 'Artist') // Find the userType
 ->where(function ($query) {
     $query->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word5', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5]);
 }) 
 ->paginate(6); // NEED TO DETERMINE HOW MANY USERS WILL BE RETURNED
 
 
             //What if no user is found we need to tell the user to edit their recommendation details
 
 // THIS IS USERTYPE = Artist,GENRE,WORDS Query (Working)
 $recommendationBandQuery=  User::where('id', '<>', Auth::user()->id)

 ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details *Required*
 ->where('genre', '=' , Auth::user()->recommendationGenre) // This is a required where clause for all statements  *Required*
 ->where('userType', '=' , 'Band') // Find the userType
 ->where(function ($query) {
     $query->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
           ->orWhereIn('word5', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5]);
 }) 
 ->paginate(6); // NEED TO DETERMINE HOW MANY USERS WILL BE RETURNED


//Below are Test Querys to try and find the word attached to the user (Find Username)

        //IF return is successful - 1 point match 
   

        $recommendationQuery2=  User::where('id', '<>', Auth::user()->id)
        ->select('username')
        ->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->paginate(2); 
  
       
        //IF return is successful - 2 points match 
  
  
        $recommendationQuery3=  User::where('id', '<>', Auth::user()->id)
        ->select('username')
        ->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->paginate(2); 

        //IF ABOVE return is successful - 3 points match 
  
        $recommendationQuery4=  User::where('id', '<>', Auth::user()->id)
        ->select('username')
        ->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->whereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
        ->paginate(2); 
  
         //IF ABOVE return is successful - 4 points match


         $recommendationQuery5=  User::where('id', '<>', Auth::user()->id)
         ->select('username')
         ->whereIn('word1', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
         ->whereIn('word2', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
         ->whereIn('word3', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
         ->whereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
         ->whereIn('word4', [Auth::user()->recommendationWord1,Auth::user()->recommendationWord2,Auth::user()->recommendationWord3,Auth::user()->recommendationWord4 , Auth::user()->recommendationWord5])
         ->paginate(2); 

        //IF ABOVE return is successful - 5 points match


            //FInd the best match now 
                //Return ... 


//THINK WE NEED GROUPING

// IF Where clasue finds a result is true then go to next statement 
//if 
    //Word2 == what happens (Test) only word 2 not word1 // so to where cluases


  
        //NEED  TO test 

   //WHat happens if not in the DB 
   //Word2 == what happens (Test)







 //need a scoring system for if word1 = ... then 1 point
 //if score is = 2 then select the user 
 //if 1 then return that user
 //display the best score 


 //What if word is in recommendationword4 and 5 
//End search after word search as its found?if recommendationword1 is found end search  ??











      //Genre Match
       $genreMatch = DB::table('users')
            ->select('username')
            ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details 
            ->where('genre', '=' , Auth::user()->recommendationGenre)  
            ->get();
            //What if no user is found we need to tell the user to edit their recommendation details
            

       //Followers Match - need to add this into the system - (Following system)
       // $followersMatch = DB::table('users')
        //->select('username')
        //->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details 
        //->where('genre', '=' , Auth::user()->recommendationFollowers)  
        //->get();

       //Location Match
       $locationMatch = DB::table('users')
            ->select('username')
            ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details 
            ->where('location', '=' , Auth::user()->recommendationLocation)  
            ->get();
            //What if no user is found we need to tell the user to edit their recommendation details

       // Random User - Artist User
       $randomArtistUser = DB::table('users')

       //Selects is within HTML template code with PHP indentation
          ->inRandomOrder()
          ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details
          ->where('userType','Artist')//**/We need a variable to set which genre of music they release **
          ->take(1)
          ->get();

       // Random User - Band User

       $randomBandUser = DB::table('users')
       //Selects is within HTML template code with PHP indentation
       ->inRandomOrder()
       ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details
       ->where('userType','Band')//**/We need a variable to set which genre of music they release **
       ->take(1)
       ->get();


    
      //Return Variables
          return view ('pages.dashboard')
          ->with('recommendationArtistWordsQuery',$recommendationArtistWordsQuery)
          ->with('recommendationBandWordsQuery',$recommendationBandWordsQuery)
          ->with('randomArtistUser' , $randomArtistUser)
          ->with('randomBandUser' , $randomBandUser)
          ->with('genreMatch' , $genreMatch) 
          ->with('locationMatch', $locationMatch);
         

      //The most popular artist or band on the website - It could be the Auth User
    //  $mostPopularUser = DB::table('users')
      //->select('username')
      //->where('followers', '=' , Auth::user()->recommendationLocation)  
      //->get();






// or where word1 = Auth::()-> all of the recommendation , instead or OR OR OR inside that where clause









  




















    //  $records_all = DB::table(DB::raw('table1, table2, table3'))
    //  ->select('table1.*','table2.table2_id','table3.table3_id')
    //  ->whereExists(function($query) use ($date) {
     //     $query->from('table2')
     //     ->whereRaw('table2.table1_id = table1.table1_id')
     //     ->whereNotExists(function($query) use ($date) {
       //       $query->from('table3')
      //        ->whereRaw('table2.table2_id = table3.table2_id')
      //        ->whereRaw("DATE(table3.date)='" . $date . "'");
      //    });
    //  })
    //  ->orderBy('url')
   //   ->get();






        //other specs
    //    ->whereNotExists(function($query)  {
          //  $query->from('')
         //   ->whereRaw('table2.table2_id = table3.table2_id')
        //    ->whereRaw("DATE(table3.date)='" . $date . "'");
       // });
  //  })
  //  ->orderBy('url')
    //->get();
   
       // userType = Match , genre = Match  display user
   
   
       //userType = Match  - Give a random user based on userType
   
        
   
        //location = Match
   
        // ageRange = MAtch 
   
        // instruments =  match 
       
         // genre = match 
   
         //similarity = match 
   
         //words = match  -- 2 words or more = match??
   
           //return view('pages.dashboard')->with('records_all',$records_all);
   
      }
   
       //function - IF .. like .. then they may like ... 
   }
   


    
?>       