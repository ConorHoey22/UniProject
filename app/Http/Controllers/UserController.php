<?php


namespace App\Http\Controllers;


use App\Posts;
use App\Recommendation;
use App\User;
use App\Follower;
use DB;
use Auth;
use Cache;
use Session;
use View;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;








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



    public function show(Request $request, $username )
    {
    

        

        //Store and Find the user ID which then used to retrieve their profile - E.g. www._____.com/profile/1
       // $user = User::find($username);


       $user = User::where('username', $username)->first();
        if($user == null)
        {
            //User cannot be found - Return user to Error Message page explaining the problem

            $message = "The user profile that you previously tried to retrieve does not exist!";

            return redirect()->route('MyDashboard')->with('message', $message);
           
        }
        else
        {




            //Return user to the requested user profile
            $posts = $user->posts()->get();
            

         




            return view('pages.profile')->with('user' , $user)->with('posts', $posts);
        }

       
    }


    public function followFunction(Request $request, $id)
    {
    $user= User::find($id);

    //Reason for follow by User id , If the users account is deleted that is not a problem as the account as the id is unique and there will never be another same id.
    // however if a user clicks on account that no longer exists we need a validation , maybe ->exists() will work?



        if(Follower::where('follower_id','=', Auth::id())->where('userid','=',$request['id'])->exists())
        {
            $message = "You are already following this user!";

            return back()->with('message', $message);
        }

        elseif(Follower::where('follower_id','=', Auth::id())->where('userid','=',Auth::id())->exists())
        {
            $message = "You can't follow yourself!";

            return back()->with('message', $message);
        } 
 
        else
        {
            DB::table('follower')->insert(
            ['follower_id' => Auth::id(), 'userid' => $request['id']]
            );
        
            $message = "Successful - Following";

            return back()->with('message' , $message);

        }   

        

     


    }


    //Unfollow
    public function unfollowFunction(Request $request, $id)
    {

    $user= User::find($id);

        if(Follower::where('follower_id','=', Auth::id())->where('userid','=',$request['id'])->exists())
        {
            DB::table('follower')->where(
                ['follower_id' => Auth::id(), 'userid' => $request['id']]
                )->delete();
                
                    $message = "Successful - Unfollowing";
        }
        else //Validation - you can't unfollow a user who you do not follow
        {
            $message = "You do not follow this user";
        }

            return back()->with('message' , $message);
        
    }

    //upload image
    public function update_image(Request $request){

        $request->validate([
                       //VALIDATION FOR invalid formats
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $imageName = $user->id.'_image'.time().'.'.request()->image->getClientOriginalExtension();

        $request->image->storeAs('images',$imageName);

        $user->image = $imageName;
        $user->save();

        return back()
            ->with('success','You have updated image.');

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
            'recommendationAgeRange' => 'required|string|max:255',
            'recommendationCountry' => 'required|string|max:255',
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
        $recommendationAgeRange = $request['recommendationAgeRange'];
        $recommendationCountry = $request['recommendationCountry']; 
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
                $user->recommendationAgeRange = $recommendationAgeRange;
                $user->recommendationCountry = $recommendationCountry;
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


      //Update Username
      public function updateUsername(Request $request)
      {
          $user = Auth::user();

          $this->validate($request,[
            'username' => 'string|max:255|unique:users',
          ]);

          $user->username = $request['username'];

          $user->save();

          return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your username!']);
            
      }

      //Update Email
      public function updateEmail(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
          'email' => 'string|max:255|unique:users',
        ]);

        $user->email = $request['email'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your email address!']);

      }

      //Update Password
      public function updatePassword(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'password' => 'string|min:6|confirmed',
        ]);

        $user->password = bcrypt( $request['password']);

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your password!']);
      }

      //Update AgeRange
      public function updateAgeRange(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'ageRange' => 'string|max:255',
        ]);

        $user->ageRange = $request['ageRange'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your age range!']);
      }

      //Update Age
      public function updateAge(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'userAge' => 'string|max:255',
        ]);

        $user->userAge = $request['userAge'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your age!']);
      }

      //Update Country
      public function updateCountry(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'country' => 'string|max:255',
        ]);

        $user->country = $request['country'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your set country location!']);
      }

      //Update Location
      public function updateLocation(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'location ' => 'string|max:255',
        ]);

        $user->location = $request['location'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your location!']);
      }

      //Update User Type
      public function updateUserType(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'userType ' => 'string|max:255',
        ]);

        $user->userType = $request['userType'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated the user type of the profile!']);
      }

      //Update Genre
      public function updateGenre(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'genre ' => 'string|max:255',
        ]);

        $user->genre = $request['genre'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your genre!']);
      }

      //Update Description
      public function updateDescription(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'profileDescription ' => 'string|max:255',
        ]);

        $user->profileDescription = $request['profileDescription'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your profile Description!']);
      }

      //Update SoundCloud Widget
      public function updateSoundCloudWidget(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'soundCloudWidget ' => 'string|max:255',
        ]);

        $user->soundCloudWidget = $request['soundCloudWidget'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your soundcloud widget!']);
      }

      //Update SoundCloud Profile Widget
      public function updateSoundCloudProfile(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'soundCloudProfile ' => 'string|max:255',
        ]);

        $user->soundCloudProfile = $request['soundCloudProfile'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your soundcloud profile!']);
      }

      //Update Spotify Profile
      public function updateSpotify(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'spotifyProfile' => 'string|max:255',
        ]);

        $user->spotifyProfile = $request['spotifyProfile'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your spotify profile!']);
      }

      //Update Word1
      public function updateWord1(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'word1' => 'string|max:255',
        ]);

        $user->word1 = $request['word1'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your word(1) that describes your music!']);
      }

      //Update Word2
      public function updateWord2(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'word2' => 'string|max:255',
        ]);

        $user->word2 = $request['word2'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your word(2) that describes your music!']);
      }

      //Update Word3
      public function updateWord3(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'word3' => 'string|max:255',
        ]);

        $user->word3 = $request['word3'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your word(3) that describes your music!']);
      }

      //Update Word4
      public function updateWord4(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'word4' => 'string|max:255',
        ]);

        $user->word4 = $request['word4'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your word(4) that describes your music!']);
      }

      //Update Word5
      public function updateWord5(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'word5' => 'string|max:255',
        ]);

        $user->word5 = $request['word5'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your word(5) that describes your music!']);
      }

      //Update Similarity
      public function updateSimilarity(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'similarity' => 'string|max:255',
        ]);

        $user->similarity = $request['similarity'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your artist/band you are similar to!']);
      }

       //Update Similarity
       public function updateInstruments(Request $request)
       {
         $user = Auth::user();
 
         $this->validate($request,[
             'instruments' => 'string|max:255',
         ]);
 
         $user->instruments = $request['instruments'];
 
         $user->save();
 
         return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your main instrument used in your music!']);
       }




      //Update Recommendation AgeRange
      public function updateRecommendationAgeRange(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationAgeRange' => 'string|max:255',
        ]);

        $user->recommendationAgeRange = $request['recommendationAgeRange'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation age range!']);
      }

      //Update Age
      public function updateRecommendationAge(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationAge' => 'string|max:255',
        ]);

        $user->recommendationAge = $request['recommendationAge'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation age!']);
      }

      //Update Country
      public function updateRecommendationCountry(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationCountry' => 'string|max:255',
        ]);

        $user->recommendationCountry = $request['recommendationCountry'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation country location!']);
      }

      //Update Location
      public function updateRecommendationLocation(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationLocation ' => 'string|max:255',
        ]);

        $user->recommendationLocation = $request['recommmendationLocation'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation location!']);
      }

      //Update User Type
      public function updateRecommendationUserType(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationUserType ' => 'string|max:255',
        ]);

        $user->recommendationUserType = $request['recommmendationUserType'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation user type!']);
      }

      //Update Genre
      public function updateRecommendationGenre(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationGenre ' => 'string|max:255',
        ]);

        $user->recommendationGenre = $request['recommendationGenre'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendationGenre!']);
      }



      //Update Word1
      public function updateRecommendationWord1(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationWord1' => 'string|max:255',
        ]);

        $user->recommendationWord1 = $request['recommendationWord1'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation word(1)!']);
      }

      //Update Word2
      public function updateRecommendationWord2(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationWord2' => 'string|max:255',
        ]);

        $user->recommendationWord2 = $request['recommendationWord2'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation word(2)!']);
      }

      //Update Word3
      public function updateRecommendationWord3(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommmendationWord3' => 'string|max:255',
        ]);

        $user->recommendationWord3 = $request['recommendationWord3'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation word(3)!']);
      }

      //Update Word4
      public function updateRecommendationWord4(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationWord4' => 'string|max:255',
        ]);

        $user->recommendationWord4 = $request['recommendationWord4'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation word(4)!']);
      }

      //Update Word5
      public function updateRecommendationWord5(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationWord5' => 'string|max:255',
        ]);

        $user->recommendationWord5 = $request['recommendationWord5'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation word(5)!']);
      }

      //Update Similarity
      public function updateRecommendationSimilarity(Request $request)
      {
        $user = Auth::user();

        $this->validate($request,[
            'recommendationSimilarity' => 'string|max:255',
        ]);

        $user->recommendationSimilarity = $request['recommendationSimilarity'];

        $user->save();

        return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your similarity artist/band that your looking for!']);
      }

       //Update Similarity
       public function updateRecommendationInstruments(Request $request)
       {
         $user = Auth::user();
 
         $this->validate($request,[
             'recommendationInstruments' => 'string|max:255',
         ]);
 
         $user->recommendationInstruments = $request['recommendationInstruments'];
 
         $user->save();
 
         return redirect()->route('MyProfile')->with(['message' => 'Successfully updated your recommendation instrument!']);
       }


      public function MyDashboard()
      {



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







      //Genre Match
       $genreMatch = DB::table('users')
            ->where('id', '!=', Auth::id()) // Can't be the  current Auth User Details 
            ->where('genre', '=' , Auth::user()->recommendationGenre)  
            ->get();
            //What if no user is found we need to tell the user to edit their recommendation details
            

      

       //Location Match
       $locationMatch = DB::table('users')
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


 // List of all the users that the logged in user is following 

$following = DB::table('users')
 
   ->leftJoin('follower','follower.userid', '=', 'users.id')
   ->where('follower.follower_id', '=', Auth::id())
   ->get();

      //Return Variables
          return view ('pages.dashboard')
          ->with('recommendationArtistWordsQuery',$recommendationArtistWordsQuery)
          ->with('recommendationBandWordsQuery',$recommendationBandWordsQuery)
          ->with('randomArtistUser' , $randomArtistUser)
          ->with('randomBandUser' , $randomBandUser)
          ->with('genreMatch' , $genreMatch)
          ->with('locationMatch', $locationMatch)
          ->with('following' , $following);
          //->with('response' , $response);
         

   
      }
   

   }
   


    
?>       