@extends('layouts.userLayout')

@section('content')

<!--CSS FILE-->
<link rel="stylesheet" href="/css/dailyMusic.css"/>

            <div class = "heading">
               <h1>Search for a random artist or band by genre!</h1>
            </div>

<!--Single Genre Search Form ,  value selection is sent to the related controller function-->
            <div class="form-group row">
                    <br>
                     <label for="Select a Genre" class="col-md-4 col-form-label text-md-right">{{ __('Select a genre to find an random artist/band:') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="/basicSearchUpdate">
                                @csrf 
                                 <!-- Gerne Dropdown Selection-->
                                <select name="genreList" id="genreList" class="form-control input" required>
                                </select>
                                <br>
                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>                   
               
                <!--Advanced Search Form-->
                <div class = "HowToGuide">
                   <h1>Advanced Search - Search for a random artist/band by gerne, instrumentalness or liveness</h1>
                        <p>How to guide:</p>
                        <p> Instrumentalness: Determines whether an artists tracks contains no vocals however “Ooh” and “aah” sounds are treated as instrumental. The closer the instrumentalness value is to 1.0, the greater chance the track or artist contains no vocals or contains lots of instruments and vocals.</p>
                        <p> E.g Set the gerne to Study and instrumentalness minimum value to 0.9 and maximum to 1.0.</p> 
                        <p> Liveness: Determines whether an artists tracks are recorded live or record at a show.</p>
                </div>
                <br>
                <!--Advance Search form selection , values are sent to the related controller function-->
                <div class="form-group row">
                     <label for="Select some characteristics" class="col-md-4 col-form-label text-md-right">{{ __('Select some characteristics: ') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="/advancedSearchUpdate">
                                @csrf 
                                 <!-- Gerne Dropdown Selection-->
                                <select name="advancedGenreList" id="advancedGenreList" class="form-control input" required>
                                </select>

                                 <!-- Instrumental Min Dropdown Selection-->
                                <select name="instrumentalnessMin" id="instrumentalnessMin" class="form-control input" >
                                </select>
                                
                                <!-- Instrumental Min Dropdown Selection-->
                                <select name="instrumentalnessMax" id="instrumentalnessMax" class="form-control input" >
                                </select>
                                
                                <!-- Liveness Max Dropdown Selection-->
                                <select name="livenessMin" id="livenessMin" class="form-control input" >
                                </select>

                                <!-- Liveness Min Dropdown Selection-->
                                <select name="livenessMax" id="livenessMax" class="form-control input" >
                                </select>
                                
                                <br>
                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>      
                    
                          
                    </div>
                   
                   </div>
               
                <!-- FILL DROPDOWN WITH FLOAT ACOUSTICNESS JSON FILE--->
                <script src = "/js/populateAdvancedSearch.js"></script> 
                
                <!-- FILL DROPDOWN WITH SPOTIFY GENRE JSON FILE--->
                <script src = "/js/populateGenres.js"></script>   
              
@endsection
