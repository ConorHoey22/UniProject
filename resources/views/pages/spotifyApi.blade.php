@extends('layouts.userLayout')

    <!-- Spotify Profile Template / Card-->
    
@section('content')
   <div class = profileContainer>

        <div class = SpotifyProfileName> <!--Username-->
            <p><center><?php echo $SpotifyName?></center></p>
            
        </div>

        <div class = profileImage> <!--Artist/ band name Image-->
     
            <center><img src = "<?php echo $SpotifyImage?>" height = "200" width = "200"></center>

        </div>

        <div class = profileURL> <!--URL-->
       <br>
        <center><a href = "<?php echo $SpotifyURL; ?>" target="_blank" class="btn btn-default">Check them out on Spotify</a></center>
        
        </div>
        
        

        <div class = profileAlbumView>
         <center>   <iframe src="https://open.spotify.com/embed/album/<?php echo $SpotifyAlbumView?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></center>
        </div>



@endsection