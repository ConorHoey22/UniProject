@extends('layouts.userLayout')

@section('content')


<script>

</script>





<div class = "welcome_container">
    <p>Welcome __________</p>
    <p>Now that you have registered, it's time to find out more about your taste in music!</p>
</div>

<!--IF UserType == Artist or Band-->
<div class = "platforms_container">
    <p>Please connect at least one platform so that you can begin sharing your music!</p>
    <p>Spotify</p>
    <p>SoundCloud</p>
    <p>YouTube</p>
</div>

<div class = "socialMedia_container">
    <p>Connect your social media(Optional) </p>
    <p>Facebook</p>
    <p>Instagram</p>
    <p>Twitter</p>
</div>

<!--Genres Dropdown  - This creates a list from the Database table called musicgenres which store genres-->

<!--Select 5 genres-->

<!-- NOTE::::: What we could do is have a button --- Would you like to add another?-->

<div class = "genre1_container">
    <p>Please some the genre of music in which you enjoy listening which will help us send you a random song everyday.</p>
    
    <div class="form-group">

        <select name ="genre" id ="genre" class="form-control input-lg" style = "width:200px">     
    
        

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genre)
            <option value="{{$genre->genre}}">
            {{$genre->genre}}</option>
            @endforeach

        </select>

    </div>

</div>
{{ csrf_field() }}

<br>

<div class = "genre2_container">
 
    
    <div class="form-group">

        <select name ="genre" id ="genre" class="form-control input-lg" style = "width:200px">

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genre)
            <option value="{{$genre->genre}}">
            {{$genre->genre}}</option>
            @endforeach

        </select>

    </div>

</div>
{{ csrf_field() }}

<br>

<div class = "genre3_container">
  
    
    <div class="form-group">

        <select name ="genre" id ="genre" class="form-control input-lg" style = "width:200px">

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genre)
            <option value="{{$genre->genre}}">
            {{$genre->genre}}</option>
            @endforeach

        </select>

    </div>

</div>
{{ csrf_field() }}

<br>

<div class = "genre4_container">
   
    
    <div class="form-group">

        <select name ="genre" id ="genre" class="form-control input-lg" style = "width:200px">

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genre)
            <option value="{{$genre->genre}}">
            {{$genre->genre}}</option>
            @endforeach

        </select>

    </div>

</div>
{{ csrf_field() }}

<br>

<div class = "genre5_container">
    
    <div class="form-group">

        <select name ="genre" id ="genre" class="form-control input-lg" style = "width:200px">

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genre)
            <option value="{{$genre->genre}}">
            {{$genre->genre}}</option>
            @endforeach

        </select>

    </div>

</div>
{{ csrf_field() }}

@endsection