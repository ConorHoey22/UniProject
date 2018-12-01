@extends('layouts.userLayout')

<!---->

@section('content')
    <div class = "header">
        <p> Your Daily Music Matches </p>
    </div>
    <!--Profile Template / Card-->
    <div class = profileContainer>
        <p> Random User within this website based on your search details</p>
           
            <div class = profileHeader> <!--Username-->

            @foreach ($randomUser as $selectedUser)
           <p> {{ $selectedUser->username}}</p>   Retrieves RandomUser username
           @endforeach           

            </div>

        <div class =profileImage> <!--Artist/ band name Image-->
           
        </div>

        <div class = profileLocation> <!--Username-->


           @foreach ($randomUser as $selectedUser)
           <p> {{ $selectedUser->location}}</p>   Retrieves RandomUser username 
           @endforeach
        </div>

        <div class = promo><!--A video or link that the user wants other to see to attract them to view their profile-->

        </div>


        <div class = UserURL> <!--Link to their profile-->
            <p> Check them out!! -  </p>
        </div>

  
    </div>



        
       









      
 
<!--Single Genre Search-->
            <div class="form-group row">
                     <label for="Select a Genre" class="col-md-4 col-form-label text-md-right">{{ __('Select a genre to find an random artist/band:') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="/basicSearchUpdate">
                                @csrf 
                                <select name="genreList" id="genreList" class="form-control input" required>
                                </select>

                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>                   
               


<!--Advanced Search Form-->
<p> <label for="helpInstrumentalness" class="col-md-4 col-form-label text-md-right">{{ __('Instrumentalness:Predicts whether a track contains no vocals. “Ooh” and “aah” sounds are treated as instrumental. The closer the instrumentalness value is to 1.0, the greater likelihood the track contains no vocal content or contains lots of instruments and vocals. Values above 0.5 are intended to represent instrumental tracks.') }}</p>
                <div class="form-group row">
                     <label for="Select some characteristics" class="col-md-4 col-form-label text-md-right">{{ __('Select some characteristics: Try to select appropriate values as for example selecting a low intrumental max value with a genre that is completely instrumental : ') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="/advancedSearchUpdate">
                                @csrf 
                               <!-- <select name="genreList" id="genreList" class="form-control input" required>   TEST -->
                                <select name="advancedGenreList" id="advancedGenreList" class="form-control input" required>
                                </select>


                                <select name="instrumentalnessMin" id="instrumentalnessMin" class="form-control input" >
                                </select>

                                <select name="instrumentalnessMax" id="instrumentalnessMax" class="form-control input" >
                                </select>

                                <select name="livenessMin" id="livenessMin" class="form-control input" >
                                </select>

                                <select name="livenessMax" id="livenessMax" class="form-control input" >
                                </select>

                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>                   
               


                <!-- FILL DROPDOWN WITH FLOAT ACOUSTICNESS JSON FILE--->
                <script src = "/js/populateAdvancedSearch.js"></script> 
                
                    <!-- FILL DROPDOWN WITH SPOTIFY GENRE JSON FILE--->
                    <script src = "/js/populateGenres.js"></script>   
              
                                
                            
           
            
                           



                           
                        </div>
                   
                </div>

        
        
                     











@endsection
