<?php


namespace App\Http\Controllers;


use App\Posts;
use App\User;

use Illuminate\Http\Request;
use Auth;

use DB;


class UserController extends Controller
{
    public function index()
    {
    
    //Return user to the requested user profile

    //$posts = DB::table('posts')->where('id', auth()->id())->get();

    $posts = \Auth::user()->posts()->get();





    $AuthSoundCloudWidget = Auth::user()->soundCloudWidget;

    $AuthSoundCloudProfile = Auth::user()->soundCloudProfile;



    return view('pages.myProfile')->with('posts', $posts )->with('AuthSoundCloudWidget', $AuthSoundCloudWidget)->with('AuthSoundCloudProfile', $AuthSoundCloudProfile);



    
    }



    public function show($id)
    {
    

        

        //Store and Find the user ID which then used to retrieve their profile - E.g. www._____.com/profile/1
        $user = User::find($id);

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

            //SoundCloud details for Widgets

           //  $getUserDetails = $user = user()->get();

            // $soundCloudProfile = $getUserDetails->soundCloudProfile;
             //$soundCloudWidget = $getUserDetails->soundCloudWidget;



           //  $soundCloudWidget = $user = user()->soundCloudWidget->get();


         //  $soundCloudProfileDetails = Posts::where('soundCloudProfile', $soundCloudProfile)->first();

    
         //  $soundCloudWidgetDetails = Posts::where('soundCloudProfile', $soundCloudProfile)->first();






            return view('pages.profile')->with('user' , $user)->with('posts', $posts );
        }

       
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


//SET textarea to required 


         //Requests 
      //   $postTitle= $request['postTitle'];
      //   $postContent= $request['postContent'];
        // $userID = "";
              
         //Create a Post
       //  $posts = new Posts();
        // $posts->postTitle = $postTitle;
       //  $posts->postContent = $postContent;

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
            'country' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'userType' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'profileDescription' => 'required|string|max:255',
            'soundCloudWidget' => 'required|string|max:255',
            'soundCloudProfile' => 'required|string|max:255',

        ]);

        //Requests 
        $username = $request['username'];
        $email= $request['email'];
        $password = bcrypt( $request['password']);
        $country = $request['country'];
        $location = $request['location'];
        $userType = $request['userType'];
        $genre = $request['genre'];
        $profileDescription= $request['profileDescription'];
        $soundCloudWidget = $request['soundCloudWidget'];
        $soundCloudProfile = $request['soundCloudProfile'];

        //Create User
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->country = $country;
        $user->location = $location;
        $user->userType = $userType;
        $user->genre = $genre;
        $user->profileDescription = $profileDescription;
        $user->soundCloudWidget = $soundCloudWidget;
        $user->soundCloudProfile = $soundCloudProfile;
        

        $user->save();
        
        Auth::login($user);
        
        //Redirect to Recommendation screen 
        return redirect()->route('dashboard');

    }

    public function postSignIn(Request $request)
    {

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            //redirect users to dashboard
            return redirect()->route('dashboard');
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


}
    
?>       