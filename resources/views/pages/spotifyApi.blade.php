@extends('layouts.userLayout')

    <!-- Spotify Profile Template / Card-->
    
@section('content')
    <div class = profileContainer>

        <div class = SpotifyProfileName> <!--Username-->
            <p><?php echo $SpotifyName?></p>
            
        </div>

        <div class = profileImage> <!--Artist/ band name Image-->
     
            <img src = "<?php echo $SpotifyImage?>" height = "200" width = "200">

        </div>

        <div class = profileURL> <!--URL-->
       
        <a href = "<?php echo $SpotifyURL; ?>" target="_blank" class="btn btn-default">Check them out on Spotify</a>
        
        </div>
        
        

        <div class = profileAlbumView>
            <iframe src="https://open.spotify.com/embed/album/<?php echo $SpotifyAlbumView?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
        </div>



@endsection