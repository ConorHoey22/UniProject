@extends('layouts.userLayout')

<!-- Profile-->

@section('content')
<link href="/css/design.css" rel="stylesheet" type="text/css">



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-body">
                    <center>
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
               


                <img class="img-rounded" src= "/storage/app/public/images/{{ Auth::user()->image }}" width=70/>  
                    <div class="rank-label-container">
                        <span class="label label-default rank-label">{{$user->name}}</span>
                    </div>
                </div>
            </div>
        </div>






        <div class="row justify-content-center">
            <form action="{{ route('upload_image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </center>

<br>





<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#profileModal">Edit Profile Details</button>
<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#recommendationModal">Edit Recommendation Details</button>

<!--Modal: This will only appear once the user click the "Edit Profile" Button-->
    <div class="modal fade" id="profileModal"  tabindex="-1" role="dialog" aria-labelledby="profileModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="profileModalLabel">Edit Profile Details</h4>
            </div>

        <div class="modal-body"> 

                    
                 <!--Update Username-->
                     <form method="POST" action="{{ route('updateUsername') }}" enctype="multipart/form-data">
                      @csrf
                        <!--Change Username-->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                              <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autofocus>  
                                                        
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif

                                    </span>
                     </form>
                                </div>
                            </div>


                        <!--Update email-->
                        <form method="POST" action="{{ route('updateEmail') }}" enctype="multipart/form-data">
                        @csrf
                       <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                <!--User Validation-->
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        </form>


                        <!--Password-->
                        <form method="POST" action="{{ route('updatePassword') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                <!--User Validation-->
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--Confirm password-->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" > <!-- Required??-->
                            </div>
                        </div>
                        </form>


                         <!--Location-->
                         <form method="POST" action="{{ route('updateLocation') }}" enctype="multipart/form-data">
                         @csrf
                         <div class="form-group row">         
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Town/City:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="location" type="text"  name="location" class= "form-control">
                            </div>
                        </div>   
                        </form>


                        <!--Country-->  
                        <form method="POST" action="{{ route('updateCountry') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="country" type="text"  name="country" class= "form-control">
                            </div>
                        </div>
                        </form>


                        <!--Age-->
                        <form method="POST" action="{{ route('updateAge') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age ( Age of the main user ):') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <p>Enter your age below (*This can be changed*)</p>
                                <input id="userAge" type="text"  name="userAge" class= "form-control">
                            </div>
                        </div>
                        </form>


                        <!--AgeRange-->
                        <form method="POST" action="{{ route('updateAgeRange') }}" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age Ranges (*Bands Only*):') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <select name="ageRange" id="ageRange" class="form-control input">
                                </select>
                            </div>

                         </div>
                        </form>


                        <!--UserTypes-->
                        <form method="POST" action="{{ route('updateUserType') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="userType" class="col-md-4 col-form-label text-md-right">{{ __('Type of user:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                                <div class="col-md-6">
                                    <select name = "userType" id="userType" class="form-control input">
                                        <option></option>
                                        <option value="Artist">Artist</option>
                                        <option value="Band">Band</option>
                                    </select>
                                </div>
                        </div>
                        </form>




                         <!--Prefered Genre -->
                         <form method="POST" action="{{ route('updateGenre') }}" enctype="multipart/form-data">
                         @csrf
                         <div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Please select a genre of music you usually peform:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                                <div class="col-md-6">
                                    <select name = "genre" id="genre" class="form-control input">
                                        
                                    </select>
                                </div>
                   
                        </div>
                        </form>

                        <!--Profile Description-->
                        <form method="POST" action="{{ route('updateDescription') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="profileDescription" class="col-md-4 col-form-label text-md-right">{{ __('Profile Description:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="profileDescription" type="text"  name="profileDescription" class= "form-control">
                            </div>
                        </div>  
                        </form>


                        <!--SoundCloud Widget-->
                        <form method="POST" action="{{ route('updateSoundCloudWidget') }}" enctype="multipart/form-data">
                         @csrf
                            <div class="form-group row">
                                <label for="soundCloudWidget" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
                                <button type="submit" class="btn btn-primary">Update</button>
                                    <div class="col-md-6">
                                    <input id="soundCloudWidget" type="text"  name="soundCloudWidget" class= "form-control">
                                </div>
                            </div>
                        </form>

            
                    <!--SoundCloud Logo which link to your profile-->
                    <form method="POST" action="{{ route('updateSoundCloudProfile') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Update</button>
                            <label for="soundCloudProfile" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
                            <div class="col-md-6">
                                <input id="soundCloudProfile" type="text"  name="soundCloudProfile" class= "form-control">
                            </div>
                        </div>
                    </form>

                    <!--Spotify Logo which link to your profile-->
                    <form method="POST" action="{{ route('updateSpotify') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Update</button>
                            <label for="spotifyProfile" class="col-md-4 col-form-label text-md-right">{{ __('Attach your Spotify Details:') }}</label>
                            <div class="col-md-6">
                                <input id="spotifyProfile" type="text"  name="spotifyProfile" class= "form-control">
                            </div>
                        </div>
                    </form>



                    <p>Choose 5 words that describe your style of music</p>
                    <!--Word 1 -- Used to describe the artists/bands style of music-->
                    <form method="POST" action="{{ route('updateWord1') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word1Btn">Update</button>
                            <div class="col-md-6">
                                <select name = "word1" id="word1" class="form-control input"> 
                                </select>
                            </div>
                        </div>
                    </form>


                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateWord1') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word1InputBtn">Update using input word</button>
                            <div class="col-md-6" >
                                <input id="word1input" type="text"  name="word1" class= "form-control input">
                            </div>
                        </div>   

                    </form>


                    <!--Word 2-- Used to describe the artists/bands style of music-->
                    <form method="POST" action="{{ route('updateWord2') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word2Btn">Update</button>       
                            <div class="col-md-6">
                                <select name = "word2" id="word2" class="form-control input">
                                </select>
                            </div>
                        </div>
                    </form>

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateWord2') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word2InputBtn">Update using input word</button>
                                <div class="col-md-6">
                                    <input id="word2input" type="text"  name="word2" class= "form-control input">
                            </div>
                        </div>   
                    
                    </form>


                <!--Word 3-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateWord3') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word3Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "word3" id="word3" class="form-control input">
                            </select>
                        </div>
                    </div>
                </form>

                <!--Enter a word option - only if the user selects enter a word in the selection box-->
                <form method="POST" action="{{ route('updateWord3') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word3InputBtn">Update using input word</button>
                            <div class="col-md-6" >
                                <input id="word3input" type="text"  name="word3" class= "form-control input">
                            </div>
                    </div>   

                </form>


                <!--Word 4-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateWord4') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word4Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "word4" id="word4" class="form-control input">
                            </select>
                        </div>
                    </div>
                
                </form>
          

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateWord4') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word4InputBtn">Update using input word</button>
                            <div class="col-md-6"> 
                                <input id="word4input" type="text"  name="word4" class= "form-control input">     
                            </div>
                        </div>   

                    </form>

               



                <!--Word 5-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateWord5') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word5Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "word5" id="word5" class="form-control input">
                            </select>
                        </div>
                    </div>
                
                </form>
          

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateWord5') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id="word5InputBtn">Update using input word</button>
                        <div class="col-md-6" >
                            <input id="word5input" type="text"  name="word5" class= "form-control input"> 
                        </div>
                    </div>   

                    </form>






                <!--Similarity Artist/Band--> <!--Artist/ BAnd only-->
                <form method="POST" action="{{ route('updateSimilarity') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <label for="similarity" class="col-md-4 col-form-label text-md-right">{{ __('Enter a similar band/artist with the same style of music:') }}</label>
                    <button type="submit" class="btn btn-primary">Update</button>
                        <div class="col-md-6">
                            <input id="similarity" type="text"  name="similarity" class= "form-control input" placeholder = "Enter a similar artist or band">
                        </div>
                    </div>
                </form>

                <!--Instrument mainly used-->
                <form method="POST" action="{{ route('updateInstruments') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <label for="instruments" class="col-md-4 col-form-label text-md-right">{{ __('Enter the main instruments used in your music:') }}</label>
                    <button type="submit" class="btn btn-primary">Update</button>
                        <div class="col-md-6">
                            <input id="instruments" type="text"  name="instruments" class= "form-control input" placeholder = "Enter the main instrument">
                        </div>
                    </div>     

                </form>

                </div>

                <div class="modal-footer">
                   
                        </div>
                    </div>
                </div>

            </div>







                             
                                </div>




<!--Modal : Edit Recommendation -->

<!--Modal: This will only appear once the user click the "Edit Profile" Button-->
<div class="modal fade" id="recommendationModal"  tabindex="-1" role="dialog" aria-labelledby="recommendationModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="recommendationModalLabel">Edit Recommendation Details</h4>
            </div>

        <div class="modal-body"> 

     

                    
                         <!--Location-->
                         <form method="POST" action="{{ route('updateRecommendationLocation') }}" enctype="multipart/form-data">
                         @csrf
                         <div class="form-group row">         
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Town/City:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="recommendationLocation" type="text"  name="recommendationLocation" class= "form-control"/>
                            </div>
                        </div>   
                        </form>


                        <!--Country-->  
                        <form method="POST" action="{{ route('updateRecommendationCountry') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <input id="recommendationCountry" type="text"  name="recommendationCountry" class= "form-control"/>
                            </div>
                        </div>
                        </form>


                        <!--Age-->
                        <form method="POST" action="{{ route('updateRecommendationAge') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age ( Age of the main user ):') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <p>Enter your age below (*This can be changed*)</p>
                                <input id="recommendationAge" type="text"  name="recommendationAge" class= "form-control"/>
                            </div>
                        </div>
                        </form>


                        <!--AgeRange-->
                        <form method="POST" action="{{ route('updateRecommendationAgeRange') }}" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age Ranges (*Bands Only*):') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <div class="col-md-6">
                                <select name="recommendationAgeRange" id="recommendationAgeRange" class="form-control input">
                                </select>
                            </div>

                         </div>
                        </form>


                        <!--UserTypes-->
                        <form method="POST" action="{{ route('updateRecommendationUserType') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row">
                            <label for="userType" class="col-md-4 col-form-label text-md-right">{{ __('Type of user:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                                <div class="col-md-6">
                                    <select name ="recommendationUserType" id="recommendationUserType" class="form-control input">
                                        <option></option>
                                        <option value="Artist">Artist</option>
                                        <option value="Band">Band</option>
                                    </select>
                                </div>
                        </div>
                        </form>




                         <!--Prefered Genre -->
                         <form method="POST" action="{{ route('updateRecommendationGenre') }}" enctype="multipart/form-data">
                         @csrf
                         <div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Please select a genre of music you usually peform:') }}</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                                <div class="col-md-6">
                                    <select name ="recommendationGenre" id="recommendationGenre" class="form-control input">
                                        
                                    </select>
                                </div>
                   
                        </div>
                        </form>



                    <p>Choose 5 words that describe your style of music</p>
                    <!--Word 1 -- Used to describe the artists/bands style of music-->
                    <form method="POST" action="{{ route('updateRecommendationWord1') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word1Btn">Update</button>
                            <div class="col-md-6">
                                <select name = "recommendationWord1" id="recommendationWord1" class="form-control input"> 
                                </select>
                            </div>
                        </div>
                    </form>


                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateRecommendationWord1') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word1InputBtn">Update using input word</button>
                            <div class="col-md-6" >
                                <input id="word1input" type="text"  name="recommendationWord1" class= "form-control input">
                            </div>
                        </div>   

                    </form>


                    <!--Word 2-- Used to describe the artists/bands style of music-->
                    <form method="POST" action="{{ route('updateRecommendationWord2') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word2Btn">Update</button>       
                            <div class="col-md-6">
                                <select name ="recommendationWord2" id="recommendationWord2" class="form-control input">
                                </select>
                            </div>
                        </div>
                    </form>

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateRecommendationWord2') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word2InputBtn">Update using input word</button>
                                <div class="col-md-6">
                                    <input id="recommendationword2input" type="text"  name="recommendationWord2" class= "form-control input">
                            </div>
                        </div>   
                    
                    </form>


                <!--Word 3-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateRecommendationWord3') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word3Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "word3" id="recommendationWord3" class="form-control input">
                            </select>
                        </div>
                    </div>
                </form>

                <!--Enter a word option - only if the user selects enter a word in the selection box-->
                <form method="POST" action="{{ route('updateRecommendationWord3') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word3InputBtn">Update using input word</button>
                            <div class="col-md-6" >
                                <input id="reword3input" type="text"  name="recommendationWord3" class= "form-control input">
                            </div>
                    </div>   

                </form>


                <!--Word 4-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateRecommendationWord4') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word4Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "recommendationWord4" id="recommendationWord4" class="form-control input">
                            </select>
                        </div>
                    </div>
                
                </form>
          

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateRecommendationWord4') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                        <button type="submit" class="btn btn-primary" id="word4InputBtn">Update using input word</button>
                            <div class="col-md-6"> 
                                <input id="word4input" type="text"  name="recommendationWord4" class= "form-control input">     
                            </div>
                        </div>   

                    </form>

               



                <!--Word 5-- Used to describe the artists/bands style of music-->
                <form method="POST" action="{{ route('updateRecommendationWord5') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id = "word5Btn">Update</button>
                        <div class="col-md-6">
                            <select name = "recommendationWord5" id="word5" class="form-control input">
                            </select>
                        </div>
                    </div>
                
                </form>
          

                    <!--Enter a word option - only if the user selects enter a word in the selection box-->
                    <form method="POST" action="{{ route('updateRecommendationWord5') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row">
                    <button type="submit" class="btn btn-primary" id="word5InputBtn">Update using input word</button>
                        <div class="col-md-6" >
                            <input id="word5input" type="text"  name="recommendationWord5" class= "form-control input"> 
                        </div>
                    </div>   

                    </form>






                <!--Similarity Artist/Band--> <!--Artist/ BAnd only-->
                <form method="POST" action="{{ route('updateRecommendationSimilarity') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <label for="similarity" class="col-md-4 col-form-label text-md-right">{{ __('Enter a similar band/artist with the same style of music:') }}</label>
                    <button type="submit" class="btn btn-primary">Update</button>
                        <div class="col-md-6">
                            <input id="recommendationSimilarity" type="text"  name="recommendationSimilarity" class= "form-control input" placeholder = "Enter a similar artist or band">
                        </div>
                    </div>
                </form>

                <!--Instrument mainly used-->
                <form method="POST" action="{{ route('updateRecommendationInstruments') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                    <label for="instruments" class="col-md-4 col-form-label text-md-right">{{ __('Enter the main instruments used in your music:') }}</label>
                    <button type="submit" class="btn btn-primary">Update</button>
                        <div class="col-md-6">
                            <input id="recommendationInstruments" type="text"  name="recommendationInstruments" class= "form-control input" placeholder = "Enter the main instrument">
                        </div>
                    </div>     

                </form>

                </div>

                <div class="modal-footer">
                   
                        </div>
                    </div>
                </div>

            </div>

                                </div>


                                <!--Username of current Logged in user--  {{ Auth::user()->username }} -->
                                <div class = "displayCurrentUser">
                                  

                                            <p> {{ Auth::user()->username}} </p>
                            
                                 
                                </div>

                                <!--Location of current Logged in user-->
                                <div class = "displayLocation">
                               
                              

                                        <p> Location: {{ Auth::user()->location}} </p>

                            

                                </div>

                                <!--Type of UserType of current Logged in user-->
                                <div class = "displayUserType">
                                   
                                    <p>User type:  {{ Auth::user()->userType}} </p>

                                </div>

                                <!--Social Media of current Logged in user-->
                                <div class = "ProfileDescription">
                           <center>     <h3><b><u>My Description</b></u></h3>
                                    <!--This value needs to inserted during registration-->
                                    <p> {{ Auth::user()->profileDescription}} </p>
                                
                                </div>
                                
                                <!-- Create a Post Form -->
                                <section>

                                <div class = "PostCreator">
          
                                <h3><u><b>Create Post</u></b></h3>
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
                                    
                                     <h3><u><b>Posts</u></b></h3>
                        

                                 @foreach ($posts as $UserPost)
                                <article class = "post">
                                    <p> {{ $UserPost->postTitle}}</p>
                                    <p> {{ $UserPost->postContent}}</p>

                                     <div class = "DateOfPost">
                                         <p>Date: {{ $UserPost->created_at}}</p>
                                     </div>
            

                                    <div class = UserInteraction>
            
                                        <button type="button" class="btn btn-primary"> 
                                        <a href="{{ route('post.delete', ['post_id' => $UserPost->id]) }}" style="color:inherit"> Delete this post</a>
                                        </button>

                                    </div>

                                </article>
                                @endforeach
                            </div>
                            </section>
</center>

                         <!--SoundCloud of current Logged in user-->
                         <div class = "SoundCloud">
                               
                            <h3><u><b>My SoundCloud</b></u></h3>
                                <iframe allowtransparency="true" scrolling="no" frameborder="no" src="https://w.soundcloud.com/icon/?url=http%3A%2F%2Fsoundcloud.com%2F<?php echo $AuthSoundCloudWidget?> &color=black_white&size=32" style="width: 32px; height: 32px;"></iframe>
                               
                               
                               <iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $AuthSoundCloudProfile?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                                                                 
                          </div>
                               
                                                             
                                 <!--Spotify of current Logged in user-->
                                 <div class = "Spotify">
                                <h3><u><b>My Spotify</b></u></h3>
                                <iframe src="https://open.spotify.com/follow/1/?uri=spotify:user:<?php echo $AuthSpotifyProfile?>&size=detail&theme=light" width="300" height="56" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>
                                        
                                </div> 








   <!-- FILL AGE RANGES DROPDOWN WITH JSON FILE--->
   <script src = "/js/populateAgeRanges.js"></script>   

<!-- FILL DROPDOWN WITH GENRE JSON FILE--->
<script src = "/js/populateGenres.js"></script>   

 <!-- FILL DROPDOWN WITH Words JSON FILE--->
<script src = "/js/populateWords.js"></script>   






                         </div>

               </div>
            </div>
        </div>
    </div>
</div>
                 
        
  </center>



@endsection
