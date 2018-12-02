@extends('layouts.userLayout')

    <!-- Spotify unable to find an artist/band - Error Message-->
    
@section('content')
        <div class = "errorMessage">

            <p>Unable to find a match with your requirements.Please try again and select more appropriate values</p>
   
            <p>This feature requires an Internet connection, Check your connection.</p>
        </div>


@endsection