@extends('layouts.userLayout')

<!---->

@section('content')
    <div class = "header">
        <p> Your Daily Music Match </p>
    </div>
    <!--Profile Template / Card-->
    
    <div class = profileContainer>

        <div class = profileHeader> <!--Username-->
   
           @foreach ($randomUser as $selectedUser)
           <p> {{ $selectedUser->username}}</p>   <!--Retrieves RandomUser username -->
           @endforeach
      
        </div>

        <div class =profileImage> <!--Artist/ band name Image-->
           
        </div>

         <div class = profileLocation> <!--Username-->
   
            @foreach ($randomUser as $selectedUser)
            <p> {{ $selectedUser->location}}</p>   <!--Retrieves RandomUser username -->
            @endforeach

        </div>

        <div class = promo><!--A video or link that the user wants other to see to attract them to view their profile-->

        </div>


        <div class = UserURL> <!--Link to their profile-->
            <p> Check them out!! -  </p>
        </div>



    </div>

    <div class = profile>
        <p>  </p>
    </div>

@endsection
