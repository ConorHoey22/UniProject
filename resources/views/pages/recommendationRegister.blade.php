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
                     <label for="Select some genres" class="col-md-4 col-form-label text-md-right">{{ __('Select some genres') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="">
                                @csrf 
                                 <!-- Genre Dropdown Selection-->
                                <select name="genreList" id="genreList" class="form-control input" required>
                                </select>
                                <br>
                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>    
        </div>


    <!-- Words to find a match   / Selection of a few words  -->
    <div class = "WordsList" >
                    <div class="form-group row">
                         <br>
                     <label for="Select some words" class="col-md-4 col-form-label text-md-right">{{ __('Select some words') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="">
                                @csrf 
                                 <!-- Genre Dropdown Selection-->
                                <select name="wordList" id="wordList" class="form-control input" required>
                                </select>
                                <br>
                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>    
        </div>

    </div>

    <!-- Age range of Artist/Band -->
    <div class = "AgeRangeList">
        <div class="form-group row">
                         <br>
                     <label for="Select an age range" class="col-md-4 col-form-label text-md-right">{{ __('Select an age range') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="">
                                @csrf 
                                 <!-- Age Range Dropdown Selection-->
                                <select name="ageRangeList" id="ageRangeList" class="form-control input">
                                </select>
                                <br>
                                <input type="submit" value="Submit">
                            </form> 
                        </div>
                    </div>    
        </div>
    </div>

    <!-- Location of the Artist/Band -->
    <div class = "LocationInput">
        <div class="form-group row">
                         <br>
                     <label for="Enter a Location" class="col-md-4 col-form-label text-md-right">{{ __('Enter a location') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="">
                                @csrf 
                                 <!-- Location input box-->
                                 <input id="locationOfMatch" type="text"  name="locationOfMatch" class= "form-control">

                                <br>
                                <input type="submit" value="Submit">
                            </form> 
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
                                <form method="POST" action="">
                                    @csrf 
                                    <!-- Instruments List Dropdown Selection-->
                                    <select name="instrumentList" id="instrumentList" class="form-control input">
                                    </select>

                                    <!--OR WE DECIDE LATER WHICH -->
                                          <!-- Instruments input box-->
                                    <input id="instrumentOfMatch" type="text"  name="instrumentOfMatch" class= "form-control">



                                    <br>
                                    <input type="submit" value="Submit">
                                </form> 
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
                                <form method="POST" action="">
                                    @csrf 
                                    <!-- similarLisr List Dropdown Selection-->
                                    <select name="similarLists" id="similarLists" class="form-control input">
                                    </select>

                         

                                    <br>
                                    <input type="submit" value="Submit">
                                </form> 
                            </div>
                        </div>    
            </div>
    



    </div>
    <!-- Followers within this website --> <!-- Input or List of Ranges  -->
    <div class = "Followers">

           <div class="form-group row">
                            <br>
                        <label for="Select the amount of followers" class="col-md-4 col-form-label text-md-right">{{ __('Select the amount of followers they may have') }}</label>
                            <div class="col-md-6">
                                <form method="POST" action="">
                                    @csrf 
                                    <!-- Instruments List Dropdown Selection-->
                                    <select name="followersList" id="followersList" class="form-control input">
                                    </select>

                                    <!--OR WE DECIDE LATER WHICH -->
                                          <!-- Instruments input box-->
                                    <input id="followerList" type="text"  name="followerList" class= "form-control">



                                    <br>
                                    <input type="submit" value="Submit">
                                </form> 
                            </div>
                        </div>    
            </div>

    </div>

</div>


