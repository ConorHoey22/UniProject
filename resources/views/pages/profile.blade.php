@extends('layouts.userLayout')

<!-- Profile-->

@section('content')
<link href="/css/design.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-body">
                                <div class = "displayProfileImage">
                                    <p>
                                    <!--Profile Image-->
                                    <img class="rounded-circle" src="/storage/images/{{ $user->image }}" />
                                    
                                    </p>
                                </div>

                                <!--Username of current Logged in user--  {{ Auth::user()->username }} -->
                                <div class = "displayCurrentUser">
                                    @if (Auth::id() == $user->username)

                                            <p> {{ Auth::user()->username}} </p>
                                    @else

                                            <p> {{ $user->username }} </p>
                                    @endif
                                 
                                </div>


                                
                                <div class = "followBtn">
                    
                                        <!--Follow Button-->
                                        <a href="{{ route('user.follow', $user->id) }}" class="btn btn-s btn-info pull-right">Follow</a>
                                  
                                </div>



                                <div class = "unFollowBtn">



   
                                       
                                        <!--unFollow Button-->
                                        <a href="{{ route('user.unfollow', $user->id) }}" class="btn btn-s btn-info pull-right">unFollow</a> 

                                </div>


                                <!--Location of current Logged in user-->
                                <div class = "displayLocation">
                               
                                        <p> Location: {{ $user->location }} </p>

                                </div>

                                <!--Type of UserType of current Logged in user-->
                                <div class = "displayUserType">
                                
                                    <p> User Type: {{ $user->userType }} </p>

                                </div>

                              
                                <div class = "ProfileDescription">
                                    <h3><b><u>Description</u></b></h3>
                                    @if (Auth::id() == $user->username)

                                        <p> {{ Auth::user()->profileDescription}} </p>

                                    @else
                                  
                                        <p> {{ $user->profileDescription}} </p>

                                    @endif

                                </div>

                               
                    
                                <br>


                                



                                <div class = "posts">

                                <h3><b><u> Posts </u></b></h3>

                                 @foreach ($posts as $UserPost)

                                    <p> {{ $UserPost->postTitle}}</p>
                                    <p> {{ $UserPost->postContent}}</p>

                                     <div class = "DateOfPost">
                                         <p>Date: {{ $UserPost->created_at}}</p>
                                     </div>
                                        <br>
                                @endforeach

                                </div>



                    <!--SoundCloud of current Logged in user-->
                    <div class = "SoundCloud">
                       <h3><b><u>Check out their SoundCloud</u></b></h3>
                                      <!-- WE NEED TO PUT THE IFRAME -->
                                     <iframe allowtransparency="true" scrolling="no" frameborder="no" src="https://w.soundcloud.com/icon/?url=http%3A%2F%2Fsoundcloud.com%2F{{$user->AuthSoundCloudWidget}}&color=black_white&size=32" style="width: 32px; height: 32px;"></iframe>


                                      <iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/{{$user->AuthSoundCloudProfile}}&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                                    
                   </div>






                                 <!--Spotify of current Logged in user-->
                                 <div class = "Spotify">
                                    
                                    <h3><b>My Spotify</b></h3>
                                   
                                         <iframe src="https://open.spotify.com/follow/1/?uri=spotify:user:{{ $user->spotifyProfile }}&size=detail&theme=light" width="300" height="56" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>
                                </div> 




    




























                         </div>

               </div>
            </div>
        </div>
    </div>
</div>
                 
        
  



@endsection
