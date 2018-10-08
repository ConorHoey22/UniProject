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
    <p>Connect your social media(Optional)</p>
    <p>Facebook</p>
    <p>Instagram</p>
    <p>Twitter</p>
</div>

<!--Genres Dropdown  - This creates a list from the Database table called musicgenres which store genres-->

<!--Select 5 genres-->

<!-- NOTE::::: What we could do is have a button --- Would you like to add another?-->

<br>


    <p>Please some the genre of music in which you enjoy listening which will help us send you a random song everyday.</p>
    
    
    
    <form method="POST" action="/createProfileCreate">
    @csrf
        <select name ="genre1" id ="genre1" class="form-control input-lg" style = "width:200px">     
    
        

            <option value="">Select a Genre </option> <!--Placeholder-->

            @foreach($genre_list as $genreName)
            <option value="{{$genreName->genreName}}">
            {{$genreName->genreName}}</option>
            @endforeach

        </select>
        {{ csrf_field() }}


        
        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                              

                                    {{ __('Register') }}
                                </button>
                            </div>
        </div>

   <form>

{{ csrf_field() }}

<br>




@endsection