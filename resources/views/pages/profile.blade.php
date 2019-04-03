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
                                        <a href="{{ route('user.follow', $user->id) }}" class="btn btn-xs btn-info pull-right">Follow</a>
                                  
                                </div>



                                <div class = "unFollowBtn">

                                        <!--unFollow Button-->
                                        <a href="{{ route('user.unfollow', $user->id) }}" class="btn btn-xs btn-info pull-right">unFollow</a>

                                </div>>





                                <!--Location of current Logged in user-->
                                <div class = "displayLocation">
                               
                                @if (Auth::id() == $user->username)

                                        <p> {{ Auth::user()->location}} </p>

                                @else
                                        <p> {{ $user->location }} </p>

                                @endif

                                </div>

                                <!--Type of UserType of current Logged in user-->
                                <div class = "displayUserType">
                                   
                                @if (Auth::id() == $user->username)

                                    <p> {{ Auth::user()->userType}} </p>

                                @else

                                    <p> {{ $user->userType }} </p>

                                @endif
                                </div>

                              
                                <!--Spotify of current Logged in user-->
                                <div class = "Spotify">
                                    <p>
                                        <!-- WE NEED TO PUT THE IFRAME -->
                                    </p>
                                </div>



                                <!--SoundCloud of current Logged in user-->
                                <div class = "SoundCloud">
                                    <p>
<!-- WE NEED TO PUT THE IFRAME -->
                                    </p>
                                </div>

                                <!--Social Media of current Logged in user-->
                                <div class = "ProfileDescription">

    <!--This value needs to be attached-->

                                </div>

                                <div class = Promo>
                                    <!--Users can attach something that they want to promote - e.g a new music video-->
                                </div>

                                @if (Auth::id() == $user->username)
                                <div class = "EditProfile">
                                    <!--Then an ablity to edit-->
                                    <button a href="{{ url('/editProfile') }}">EditProfile </button>
                                </div>
                                @endif

                                <br>


                            <!--Only the Authorised User can create a post-->   
                                @if (Auth::id() == $user->username)

                                <!-- Create a Post Form -->
                                <section>

                                <div class = "PostCreator">

                                        <form method="POST" action="{{ route('createPost') }}">
                                            @csrf
                                                <div class ="form-group">
                                                    <p>Title:</p>
                                                    <textarea class = "form-control" name = "postTitle" id = "postTitle" rows = 1></textarea> 

                                                    <p>Content</p>
                                                    <textarea class = "form-control" name = "postContent" id = "postContent" rows = 4></textarea> 

                                                
                                            
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                        {{ __('Submit Post') }}
                                                        </button>
                                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                 </section>     
                                 @endif

                                







                                 @foreach ($posts as $UserPost)

                                    <p> {{ $UserPost->postTitle}}</p>
                                    <p> {{ $UserPost->postContent}}</p>

                                     <div class = "DateOfPost">
                                         <p>Date: {{ $UserPost->created_at}}</p>
                                     </div>
            

                                    <div class = UserInteraction>

                                    <p>Number of Likes:</p>
                                        <a href = "">Like</a>
                                        <a href = "">Comment</a>




                                    @if (Auth::id() == $user->username)

                                    <a href="{{ route('post.delete', ['post_id' => $UserPost->id]) }}">Delete</a>
                                    
                                    @endif                          





                                       







                                        
                                    </div>


                                @endforeach





                                <iframe allowtransparency="true" scrolling="no" frameborder="no" src="https://w.soundcloud.com/icon/?url=http%3A%2F%2Fsoundcloud.com%2F<?php echo $user->soundCloudWidget?>&color=black_white&size=32" style="width: 32px; height: 32px;"></iframe>


<iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $user->soundCloudProfile?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>





    <iframe src="https://open.spotify.com/follow/1/?uri=spotify:user:conorhoey1&size=detail&theme=light" width="300" height="56" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>




























                         </div>

               </div>
            </div>
        </div>
    </div>
</div>
                 
        
  



@endsection
