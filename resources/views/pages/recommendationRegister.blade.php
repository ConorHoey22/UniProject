@extends('layouts.userLayout')


@section('content')
<div class = "getRecommendationInfo">

        <div class = "RecommendationTitle">
            <h1> Lets find some artists or bands which you may like to listen to!</h1>
        </div>
      
      
        <form method="POST" action="{{ route('createRecommendation') }}">
        @csrf
    <!--Genre Title-->
        <div class = "GenreTitle">
            <p>Select some genres which you prefer!</p>
        </div>

    <!--Select some Genres from the list-->
        <div class = "GenreList">
                    <div class="form-group row">
                         <br>
                     <label for="Select some genres" class="col-md-4 col-form-label text-md-right">{{ __('Select some genres') }}</label>
                        <div class="col-md-6">
                            
                                 <!-- Genre Dropdown Selection-->
                                <select name="preferredGenre" id="preferredGenre" class="form-control input" required autofocus>
                                </select>
                      
                        </div>
                    </div>    
        </div>


    <!-- Words to find a match   / Selection of a few words  -->
    <div class = "WordsList" >
                    <div class="form-group row">
                         <br>
                     <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select some words') }}</label>
                        <div class="col-md-6">
                         
                                 <!-- Genre Dropdown Selection--> <!--need to change name of the field-->
                                <select name="word1" id="word1" class="form-control input" required autofocus>
                                </select>
                             
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
                                <select name="ageRange" id="ageRange" class="form-control input">
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
                                 <input id="location" type="text"  name="location" class= "form-control">

                            
                        </div>
                    </div>    
        </div>
    </div>

    <!-- Instruments the artist/band use in their music -->  <!-- list or Input -->
     <!-- Then they enter an instruments at registeration or edit , and it is added to the json file which contains a list of instruments-->
    <div class = "InstrumentsList">
        <div class="form-group row">
                            <br>
                        <label for="Select some instruments" class="col-md-4 col-form-label text-md-right">{{ __('Select some instruments') }}</label>
                            <div class="col-md-6">
                                
                                    <!-- Instruments List Dropdown Selection-->
                                    

                                    <!--OR WE DECIDE LATER WHICH -->
                                          <!-- Instruments input box-->
                                    <input id="instruments" type="text"  name="instruments" class= "form-control"> 



                                    
                            
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
                                    <input id="similarity" type="text"  name="similarity" class= "form-control">

                         

                                
                              
                            </div>
                        </div>    
            </div>
    



    </div>
    

        <!-- Age range of Artist/Band -->
        <div class = "userType">
            <div class="form-group row">
                         <br>
                     <label for="Select type of user" class="col-md-4 col-form-label text-md-right">{{ __('Select a type of user') }}</label>
                        <div class="col-md-6">
                            
                                 <!-- Age Range Dropdown Selection-->
                                <select name="userType" id="userType" class="form-control input">
                                    <option value="Artist">Artist</option>
                                    <option value="Band">Band</option>
                                </select>
                             
                        </div>
                    </div>    
        </div>
    </div>

            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Recommendation') }}
                                </button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </div>
             </div>

            </form>
       
    </div>
</div>





                <!-- FILL AGE RANGES DROPDOWN WITH JSON FILE--->
                <script src = "/js/populateAgeRanges.js"></script>   

                 <!-- FILL DROPDOWN WITH GENRE JSON FILE--->
                 <script src = "/js/populateGenres.js"></script>   

                   <!-- FILL DROPDOWN WITH Words JSON FILE--->
                   <script src = "/js/populateWords.js"></script>   

@endsection