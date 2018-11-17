@extends('layouts.profileLayout')


<!-- Profile-->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ __('Register') }}</div>
                    
                    <div class="card-body">
                                <div class = "displayProfileImage">
                                    <p>
                                    <!--Profile Image-->
                                
                                    <!-- {{ Auth::user()->profileImage }}-->

                                    </p>
                                </div>

                                <!--Username of current Logged in user--  {{ Auth::user()->username }} -->
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

                                <div class = Promo>
                                    <!--Users can attach something that they want to promote - e.g a new music video-->
                                </div>

                                <div class = "EditProfile">
                                    <!--Then an ablity to edit-->
                                    <button><a href="{{ url('/editProfile') }}">EditProfile<Button>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                 
        
  



@endsection
