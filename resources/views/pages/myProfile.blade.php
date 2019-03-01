@extends('layouts.userLayout')

<!-- Profile-->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-body">
                                <div class = "displayProfileImage">
                                    <p>
                                    <!--Profile Image-->
                                    <div class="container">
        <div class="row">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">

            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img class="rounded-circle" src="/storage/images/{{ $user->image }}" />
                    <!-- badge -->
                    <div class="rank-label-container">
                        <span class="label label-default rank-label">{{$user->name}}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <form action="/profile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>







                                    
                                    </p>
                                </div>

                                <!--Username of current Logged in user--  {{ Auth::user()->username }} -->
                                <div class = "displayCurrentUser">
                                  

                                            <p> {{ Auth::user()->username}} </p>
                            
                                 
                                </div>

                                <!--Location of current Logged in user-->
                                <div class = "displayLocation">
                               
                              

                                        <p> {{ Auth::user()->location}} </p>

                            

                                </div>

                                <!--Type of UserType of current Logged in user-->
                                <div class = "displayUserType">
                                   
                         

                                    <p> {{ Auth::user()->userType}} </p>

                                
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

                             
                                    <!--This value needs to inserted during registration-->

                                </div>

                                <div class = Promo>
                                    <!--Users can attach something that they want to promote - e.g a new music video-->
                                </div>

                                
                                <div class = "EditProfile">
                                    <!--Then an ablity to edit-->
                                    <button a href="{{ url('/editProfile') }}">EditProfile </button>
                                </div>
                              

                                <br>


                              

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

                                  <section class = "row posts">
                                    <div class ="col-md-6 col-md-offst-3">
                                     <header><h3>Posts</h3><header>
                                

                        


                                 @foreach ($posts as $UserPost)
                                <article class = "post">
                                    <p> {{ $UserPost->postTitle}}</p>
                                    <p> {{ $UserPost->postContent}}</p>

                                     <div class = "DateOfPost">
                                         <p>Date: {{ $UserPost->created_at}}</p>
                                     </div>
            

                                    <div class = UserInteraction>

                                    <p>Number of Likes:</p>
                                        <a href = "">Like</a>
                                        <a href = "">Comment</a>

                                        <a href="{{ route('post.delete', ['post_id' => $UserPost->id]) }}">Delete</a>
                                        <button data-toggle="modal" data-toggle="modal" data-target="#edit-modal" href=""> Edit</button>




                      

                           
                                                     





                                       







                                        
                                    </div>

                                </article>
                                @endforeach
                            </div>
                            </section>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      
       <form method="POST" action = "{{ route('updatePost',[$post->id])">


              <div class="form-group">
                
    
        <input class = "form-control" name="postTitle" id="postTitle" rows="1" placeholder="Update Title">
        <br>
        <input class = "form-control" name="postContent" id="postContent" rows="5" placeholder="Update Content"> 
    
        
    
    </div>
        
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="submit" id="submitUpdatePost" class="btn btn-success pull-right">Submit</button>
     </form> 
       

      </div>
    </div>
  </div>
</div>


<iframe allowtransparency="true" scrolling="no" frameborder="no" src="https://w.soundcloud.com/icon/?url=http%3A%2F%2Fsoundcloud.com%2F<?php echo $AuthSoundCloudWidget?> &color=black_white&size=32" style="width: 32px; height: 32px;"></iframe>


    <iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $AuthSoundCloudProfile?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>





        <iframe src="https://open.spotify.com/follow/1/?uri=spotify:user:conorhoey1&size=detail&theme=light" width="300" height="56" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>









                         </div>

               </div>
            </div>
        </div>
    </div>
</div>
                 
        
  



@endsection
