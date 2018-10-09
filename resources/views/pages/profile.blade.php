@extends('layouts.profileLayout')


<!-- Profile-->

@section('content')
<div class = ProfileSection>

        <div class = "displayProfileImage">
             <p>
             <!--Profile Image-->



            </p>
        </div>

          <!--Username of current Logged in user-->
         <div class = "displayCurrentUser">
             <p>
              {{ Auth::user()->username }} 
           </p>
         </div>

         <!--Location of current Logged in user-->
         <div class = "displayLocation">
              <p>
                   Location: {{ Auth::user()->location }} , {{ Auth::user()->country }} 
               </p>
          </div>

          <!--Type of UserType of current Logged in user-->
        <div class = "displayUserType">
            <p>
                Type of User: {{ Auth::user()->userType }}
            </p>
        </div>

         <!--Spotify of current Logged in user-->
        <div class = "Spotify">
            <p>

            </p>
        </div>

          <!--SoundCloud of current Logged in user-->
        <div class = "SoundCloud">
            <p>

            </p>
        </div>

         <!--Social Media of current Logged in user-->
        <div class = "ProfileDescription">

            About: {{ Auth::user()->profileDescription}}
            <!--This value needs to inserted during registration-->

        </div>

        <div class = "EditProfile">
            <!--Then an ablity to edit-->
            <button>Edit Profile<Button>
        </div>

</div>
@endsection
