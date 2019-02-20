@extends('layouts.userLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Dashboard') }}</div>
                    <br>

                    <div class="card-body">
                       
                        <div class="recommendations">

                            <p>We recommend you to check out!</p>

                                @foreach ($recommendationQuery as $selectedUser)
                            
                                    <p> {{ $selectedUser->username}}</p>  

                                @endforeach   

                           
                           
                            <p>Edit Recommentdation</p>






                        </div>

                        <div class = "recommendationGenre">

                        <p>Genre Recommendation</p>

                            @foreach ($genreMatch as $selectedUser)

                                <p> {{ $selectedUser->username}}</p>  

                            @endforeach   

                         </div>


                         <div class = "recommendationLocation">

                         <p>Location Recommendation</p>

                            @foreach ($locationMatch as $selectedUser)

                                 <p> {{ $selectedUser->username}}</p>  

                            @endforeach   

                        </div>

                        


                        <div class = "randomArtistUser">

                        <p>Random Artist </p>

                            @foreach ($randomArtistUser as $selectedUser)
                        
                                <p> {{ $selectedUser->username}}</p>  

                            @endforeach   

                        </div>


                        <div class = "randomBandUser">

                        <p>Random Artist </p>

                            @foreach ($randomBandUser as $selectedUser)
                        
                                <p> {{ $selectedUser->username}}</p>  

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
