@extends('layouts.userLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Dashboard') }}</div>
                    <br>

                    <div class="card-body">
                       
                        <div class="recommendationsWords">

                            <p>We recommend you to check out!</p>
                                
                                <div class = "recommendedArtistByWords">
                                Artist based on the recommendation words, you chose
                                    @foreach ($recommendationArtistWordsQuery as $selectedUser)
                                <!--This is where we get the image-->
                                        <p> {{ $selectedUser->username}}</p>  
                                        <p> {{ $selectedUser->userAge }}</p>
                                        <p>Click here to check them out! </p>
                                     
                                    @endforeach   
                                </div>


                                <div class = "recommendedBandByWords">
                                Band based on the recommendation words, you chose
                                    @foreach ($recommendationBandWordsQuery as $selectedUser)
                                
                                        <p> {{ $selectedUser->username}}</p>  
                                        <p> {{ $selectedUser->userAge }}</p>
                                        <p>Click here to check them out! </p>
                        
                                    @endforeach   
                                </div>

                           
                           
                            <button>Edit Recommentdation</button>






                        </div>

                        <div class = "recommendationGenre">

                        <p>Genre Recommendation</p>

                            @foreach ($genreMatch as $selectedUser)

                                <p> {{ $selectedUser->username}}</p>  
                                <p> {{ $selectedUser->userAge }}</p>
                                <p>Click here to check them out! </p>

                            @endforeach   

                         </div>


                         <div class = "recommendationLocation">

                         <p>Location Recommendation</p>

                            @foreach ($locationMatch as $selectedUser)

                                 <p> {{ $selectedUser->username}}</p>
                                 <p> {{ $selectedUser->userAge }}</p>  
                                 <p>Click here to check them out! </p>

                            @endforeach   

                        </div>

                        


                        <div class = "randomArtistUser">

                        <p>Random Artist </p>

                            @foreach ($randomArtistUser as $selectedUser)
                        
                                <p> {{ $selectedUser->username }}</p>  
                                <p> {{ $selectedUser->userAge }}</p>
                                <p>Click here to check them out! </p>
                                
                            @endforeach   

                        </div>


                        <div class = "randomBandUser">

                        <p>Random Artist </p>

                            @foreach ($randomBandUser as $selectedUser)
                        
                                <p> {{ $selectedUser->username}}</p>  
                                <p> {{ $selectedUser->userAge }}</p>
                                <p>Click here to check them out! </p>

                            @endforeach   

                        </div>




                    </div>

                        <div class="Navigation-Search">
                            <button>Search</button>
                        </div>

                    </div>
                </div>
           </div>
       </div>
    </div>
</div>

@endsection
