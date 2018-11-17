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
                <p> {{ $selectedUser->username}}</p>   <!--Retrieves RandomUser username -->
                @endforeach 

            </div>

        <div class =profileImage> <!--Artist/ band name Image-->
           
        </div>

        <div class = profileLocation> <!--Username-->

                @foreach ($randomUser as $selectedUser)
                <p> {{ $selectedUser->location}}</p>   <!--Retrieves RandomUser location -->
                @endforeach

        </div>

        <div class = promo><!--A video or link that the user wants other to see to attract them to view their profile-->

        </div>


        <div class = UserURL> <!--Link to their profile-->
            <p> Check them out!! -  </p>
        </div>



    </div>





    <!--Profile Template / Card-->
    <div class = profileContainer>

        <div class = SpotifyProfileName> <!--Username-->
        
        <p><?php echo $result[0]['album']['name'];?></p>

        </div>

        <div class = profileImage> <!--Artist/ band name Image-->

        <img src = <?php echo $result[0]['album']['images'][0]['url'];?> height = "200" width = "200" > 

        </div>

        <div class = profileLocation> <!--Username-->
        
        </div>

    </div>


@endsection
