@extends('layouts.app')

@section('content')
<!--UserType Script-->
<script src = "/js/userType.js"></script> 

<!--Words that describes the Artist/Band JavaScript -- This will allow the user to enter a word and disappear when not needed. -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                   <div class="card-body">

                     <!--Beginning of the Register Form - Values entered are sent to the RegisterController-->
                    <form method="POST" name= "registerForm" action="{{ route('postsignup') }}" enctype="multipart/form-data">
                        @csrf
                        <!--Username-->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>
                              <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <!--Email-->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <!--User Validatin-->
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Password-->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <!--Location-->
                         <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Town/City:') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text"  name="location" class= "form-control" required autofocus>
                            </div>
                        </div>   

                        <!--Country-->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text"  name="country" class= "form-control" required autofocus>
                            </div>
                        </div>

                        <!--Age-->
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age ( Age of the main user ):') }}</label>
                               
                            <div class="col-md-6">

                                <p>Enter your age below (*This can be changed*)</p>
                                <input id="userAge" type="text"  name="userAge" class= "form-control" required autofocus>
                            
                            </div>
                                
                        </div>

  <!--UserTypes-->
  <div class="form-group row">
                        <label for="userType" class="col-md-4 col-form-label text-md-right">{{ __('Type of user:') }}</label>
                            <div class="col-md-6">
                                <select name = "userType" id="userType" class="form-control input" required autofocus>
                                    <option></option>
                                    <option value="Listener">Listener</option>
                                    <option value="Artist">Artist</option>
                                    <option value="Band">Band</option>
                                </select>
                            </div>
                        </div>


<div class = "BandOnly" id= "BandOnly" style="display : none;">
    <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age Ranges of the band:') }}</label>
                               
                            <div class="col-md-6">
                                <select name="ageRange" id="ageRange" class="form-control input">
                                </select>
                            </div>

    </div>
</div>

<div class= "ArtistBandRegForm" id ="ArtistBandRegForm" style="display: none;">
      
                         <!--Prefered Genre -->
                        <div class="form-group row">
                            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Please select a genre of music you usually peform:') }}</label>
                        
                                <div class="col-md-6">
                                    <select name = "genre" id="genre" class="form-control input" >
                                        
                                    </select>
                                </div>
                   
                        </div>

                        <!--Profile Description-->
                        <div class="form-group row">
                            <label for="profileDescription" class="col-md-4 col-form-label text-md-right">{{ __('Profile Description:') }}</label>

                            <div class="col-md-6">
                                <input id="profileDescription" type="text"  name="profileDescription" class= "form-control">
                            </div>
                        </div>  

<!--SoundCloud Widget--   Not required --->
<div class="form-group row">

<label for="soundCloudWidget" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
<div class="col-md-6">
    <input id="soundCloudWidget" type="text"  name="soundCloudWidget" class= "form-control">
</div>


<div class = howToGuide>
    <p> This is the creditionals you need to enter to obtain your soundCloudID</p>
</div>

</div>


<!--SoundCloud Logo which link to your profile--   Not required -->
<div class="form-group row">

<label for="soundCloudProfile" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
<div class="col-md-6">
    <input id="soundCloudProfile" type="text"  name="soundCloudProfile" class= "form-control">
</div>
</div>

<!--Spotify Logo which link to your profile--   Not required -->
<div class="form-group row">

<label for="spotifyProfile" class="col-md-4 col-form-label text-md-right">{{ __('Attach your Spotify Details:') }}</label>
<div class="col-md-6">
    <input id="spotifyProfile" type="text"  name="spotifyProfile" class= "form-control">
</div>
</div>

 <!-- FILL AGE RANGES DROPDOWN WITH JSON FILE--->
<script src = "/js/populateAgeRanges.js"></script>   

<!-- FILL DROPDOWN WITH GENRE JSON FILE--->
<script src = "/js/populateGenres.js"></script>   

  <!-- FILL DROPDOWN WITH Words JSON FILE--->
  <script src = "/js/populateWords.js"></script>   


<p>Choose 5 words that describe your style of music</p>
<!--THIS WILL BE ONLY FOR ARTIST/BANDS-->
<!--Word 1 -- Used to describe the artists/bands style of music-->

<script type="text/javascript">

    function Check1(val)
    {
        var element=document.getElementById('word1input');
        if(val=='Enter a word')
        {
            element.style.display='block';
        }
        else  
        {
            element.style.display='none'; 
        }   
    }

</script> 

<div class="form-group row">
    <div class="col-md-6">
        <select name = "word1" id="word1" class="form-control input" onchange='Check1(this.value);'></select>
    </div>
</div>

    <!--Enter a word option - only if the user selects enter a word in the selection box -->
    <div class="form-group row">
        <div class="col-md-6">
            <input id="word1input" type="text"  name="word1" class= "form-control input" style = "display: none;">
       </div>
   </div>  




<!--Word 2-- Used to describe the artists/bands style of music-->
<div class="form-group row">
             
    <div class="col-md-6">
        <select name = "word2" id="word2" class="form-control input"></select>
    </div>

    
</div>

    <!--Enter a word option - only if the user selects enter a word in the selection box-->
    <div class="form-group row">
            <div class="col-md-6" >
                <input id="word2input" type="text"  name="word2" class= "form-control input" style = "display: none;">
            </div>
    </div>   



<!--Word 3-- Used to describe the artists/bands style of music -->
<div class="form-group row">
             
    <div class="col-md-6">
        <select name = "word3" id="word3" class="form-control input"></select>
    </div> 

</div>

    <!--Enter a word option - only if the user selects enter a word in the selection box -->
    <div class="form-group row">
            <div class="col-md-6" >
                <input id="word3input" type="text"  name="word3" class= "form-control input" style = "display: none;">
        </div>
    </div>  


<!--Word 4-- Used to describe the artists/bands style of music-->
<div class="form-group row">
            
    <div class="col-md-6">
        <select name = "word4" id="word4" class="form-control input"></select>
    </div>
</div>

    <!--Enter a word option - only if the user selects enter a word in the selection box -->
    <div class="form-group row">
            <div class="col-md-6" >
                <input id="word4input" type="text"  name="word4" class= "form-control input" style = "display: none;"> 
           </div>
    </div>   


<!--Word 5-- Used to describe the artists/bands style of music-->
<div class="form-group row">
            
    <div class="col-md-6">
        <select name = "word5" id="word5" class="form-control input"></select>
    </div>
</div>

    <!--Enter a word option - only if the user selects enter a word in the selection box -->
    <div class="form-group row">
            <div class="col-md-6" >
                <input id="word5input" type="text"  name="word5" class= "form-control input" style = "display: none;">
        </div>
    </div>   




<!--Similarity Artist/Band--> <!--Artist/ BAnd only-->
<div class="form-group row">
<label for="similarity" class="col-md-4 col-form-label text-md-right">{{ __('Enter a similar band/artist with the same style of music:') }}</label>
    <div class="col-md-6">
    <input id="similarity" type="text"  name="similarity" class= "form-control input" placeholder = "Enter a similar artist or band">
    </div>
</div>

<!--Instruments used in your music (should be able to enter more than one) -->
<div class="form-group row">
<label for="instruments" class="col-md-4 col-form-label text-md-right">{{ __('Enter the main instruments used in your music:') }}</label>
    <div class="col-md-6">
    <input id="instruments" type="text"  name="instruments" class= "form-control input" placeholder = "Enter the main instrument">
    </div>
</div>     

</div>

<script src = "/css/dailyMusic.js"></script> 

       <!-- FILL AGE RANGES DROPDOWN WITH JSON FILE--->
       <script src = "/js/populateAgeRanges.js"></script>   

<!-- FILL DROPDOWN WITH GENRE JSON FILE--->
<script src = "/js/populateGenres.js"></script>   

  <!-- FILL DROPDOWN WITH Words JSON FILE--->
  <script src = "/js/populateWords.js"></script>   


 <!--Recommendation User Details for the Recommendation System-->

<div class = "getRecommendationInfo">

<div class = "RecommendationTitle">
    <h1> Lets find some artists or bands which you may like to listen to!</h1>
</div>


<!--Genre Title-->
<div class = "GenreTitle">
    <p>Select some genres which you prefer!</p>
</div>

<!--Select some Genres from the list-->
<div class = "GenreList">
            <div class="form-group row">
                 <br>
             <label for="Select some genres" class="col-md-4 col-form-label text-md-right">{{ __('Select your preferred genre') }}</label>
                <div class="col-md-6">
                    
                         <!-- Genre Dropdown Selection-->
                        <select name="recommendationGenre" id="recommendationGenre" class="form-control input" placeholder = "Enter a genre">
                        </select>
              
                </div>
            </div>    
</div>

<div class = "Words Title">
    <p>Select some words that describe the music you like to listen to </p>
</div

>
<!-- Words to find a match   / Selection of a few words  --- FIX THIS !!  -->
<div class = "WordsList" >

            <div class="form-group row">
                <br>
                <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select a word') }}</label>
                <div class="col-md-6">
                    <!-- Word Selection --> 
                        <select name="recommendationWord1" id="recommendationWord1" class="form-control input">
                        </select>
                </div>
            </div>

            <!--Enter a word option - only if the user selects enter a word in the selection box 
           <div class="form-group row">
                  <div class="col-md-6">
                     <input id="recommendationWord1input" type="text"  name="recommendationWord1" class= "form-control input" style = "display: none;" placeholder = "Enter a word"/>
                 </div>
           </div>   -->



            <!--Word2-->
            <div class="form-group row">
                 <br>
                 <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select a word') }}</label>
                 <div class="col-md-6">
                         <!-- Word Selection -->
                        <select name="recommendationWord2" id="recommendationWord2" class="form-control input">
                        </select>            
                </div>
            </div>  

            <!--Enter a word option - only if the user selects enter a word in the selection box 
            <div class="form-group row">
                  <div class="col-md-6" >
                     <input id="recommendationWord2input" type="text"  name="recommendationWord2" class= "form-control input" style = "display: none;" placeholder = "Enter a word"/>
                 </div>
            </div>   -->




            <!--Word3-->
           <div class="form-group row">
                 <br>
             <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select a word') }}</label>
                <div class="col-md-6"> 
                
                         <!-- Word Selection -->
                         <select name="recommendationWord3" id="recommendationWord3" class="form-control input">
                        </select>
                     
                </div>
            </div>     

             <!--Enter a word option - only if the user selects enter a word in the selection box 
             <div class="form-group row">
                  <div class="col-md-6" >
                     <input id="recommendationWord3input" type="text"  name="recommendationWord3" class= "form-control input" style = "display: none;" placeholder = "Enter a word">
                 </div>
            </div>   -->




            <!--Word4-->
            <div class="form-group row">
                 <br>
             <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select a word') }}</label>
                <div class="col-md-6">
                 
         
                        <select name="recommendationWord4" id="recommendationWord4" class="form-control input">
                        </select>
                     
                </div>
            </div>  

            <!--Enter a word option - only if the user selects enter a word in the selection box -
            <div class="form-group row">
                  <div class="col-md-6" >
                     <input id="recommendationWord4input" type="text"  name="recommendationWord4" class= "form-control input" style = "display: none;" placeholder = "Enter a word" />
                 </div>
            </div>  -->

            <!--Word5-->
            <div class="form-group row">
                 <br>
             <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select a word') }}</label>
                <div class="col-md-6">
                
                        <select name="recommendationWord5" id="recommendationWord5" class="form-control input">
                        </select>
                     
                </div>
            </div> 



             <!--Enter a word option - only if the user selects enter a word in the selection box 
             <div class="form-group row">
                  <div class="col-md-6">
                     <input id="recommendationWord5input" type="text"  name="recommendationWord5" class= "form-control input" style = "display: none;" placeholder = "Enter a word" />
                 </div> 
            <div> -->

</div>



</div>
<!-- Location of the Artist/Band -->
<div class = "ageInput">
<div class="form-group row">
                 <br>
             <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Enter a age') }}</label>
                <div class="col-md-6">
                    
                         <!-- Location input box-->
                         <input id="recommendationAge" type="text"  name="recommendationAge" class= "form-control">

                    
                </div>
            </div>    
</div>
</div>
<!-- Age range of Artist/Band -->
<div class = "AgeRange">
    <div class="form-group row">
                 <br>
             <label for="Select an age range" class="col-md-4 col-form-label text-md-right">{{ __('Select an age range') }}</label>
                <div class="col-md-6">
                    
                         <!-- Age Range Dropdown Selection-->
                        <select name="recommendationAgeRange" id="recommendationAgeRange" class="form-control input">
                        </select>
                     
                </div>
            </div>    
</div>
</div>
<!-- Location of the Artist/Band -->
<div class = "LocationInput">
<div class="form-group row">
                 <br>
             <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Enter a location') }}</label>
                <div class="col-md-6">
                    
                         <!-- Location input box-->
                         <input id="recommendationLocation" type="text"  name="recommendationLocation" class= "form-control">

                    
                </div>
            </div>    
</div>
</div>

<!-- Location of the Artist/Band -->
<div class = "countryInput">
<div class="form-group row">
                 <br>
             <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Enter a country') }}</label>
                <div class="col-md-6">
                    
                         <!-- Location input box-->
                         <input id="recommendationCountry" type="text"  name="recommendationCountry" class= "form-control">

                    
                </div>
            </div>    
</div>
</div>
<!-- Instruments the artist/band use in their music -->  <!-- list or Input -->
<!-- Then they enter an instruments at registeration or edit , and it is added to the json file which contains a list of instruments-->
<div class = "InstrumentsList">
<div class="form-group row">
                    <br>
                <label for="Select some instruments" class="col-md-4 col-form-label text-md-right">{{ __('Enter the main instrument you are looking for') }}</label>
                    <div class="col-md-6">
                        
                            <!-- Instruments List Dropdown Selection-->
                            

                            <!--OR WE DECIDE LATER WHICH -->
                                  <!-- Instruments input box-->
                            <input id="recommendationInstruments" type="text"  name="recommendationInstruments" class= "form-control"> 

                    
                    </div>
                </div>    
    </div>
</div>
<!-- Similar to .. (Mumford and Sons) --> <!-- could we have the an artist/band user enter a similar band or artist which plays the same style of music-->
<!-- Then the entered band is added to the json file which contains a list of artist and bands-->
<div class = "Similar">
    <div class="form-group row">
                    <br>
                <label for="Select some similar artist or band" class="col-md-4 col-form-label text-md-right">{{ __('Select some artists or bands') }}</label>
                    <div class="col-md-6">
                     
                            <!-- similarLisr List Dropdown Selection-->
                            <input id="recommendationSimilarity" type="text"  name="recommendationSimilarity" class= "form-control">

                
                    </div>
                </div>    
    </div>

<!-- UserType-->
<div class = "userType">
    <div class="form-group row">
                 <br>
             <label for="Select type of user" class="col-md-4 col-form-label text-md-right">{{ __('Select a type of user') }}</label>
                <div class="col-md-6">
                    
                         <!-- Age Range Dropdown Selection-->
                        <select name="recommendationUserType" id="recommendationUserType" class="form-control input">
                            <option value="Artist">Artist</option>
                            <option value="Band">Band</option>
                          
                        </select>
                     
                </div>
            </div>    
    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </div>
                        </div>





                       </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>



@endsection