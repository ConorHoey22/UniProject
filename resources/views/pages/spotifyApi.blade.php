@extends('layouts.userLayout')
    
@section('content')

<!-- Spotify Profile Template / Card-->
   <div class = profileContainer>

        <!--Spotify Artist/Band Name-->
        <div class = SpotifyProfileName> <!--Username-->        
            <p><center><?php echo $SpotifyName?></center></p>       
        </div>

        <!--Spotify Artist/Band Image-->
        <div class = profileImage> <!--Artist/ band name Image-->    
            <center><img src = "<?php echo $SpotifyImage?>" height = "200" width = "200"></center>
        </div>

        <!--Spotify Artist/Band Profile Image-->
        <div class = profileURL> 
            <br>
            <center><a href = "<?php echo $SpotifyURL; ?>" target="_blank" class="btn btn-default">Check them out on Spotify</a></center>
        </div>
        
        
        <!--Spotify Artist/Band Album Viewer-->
        <div class = profileAlbumView>
             <center>   <iframe src="https://open.spotify.com/embed/album/<?php echo $SpotifyAlbumView?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></center>
        </div>


    </div>
@endsection