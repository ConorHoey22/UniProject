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
           <p> {{ $selectedUser->username}}</p>   Retrieves RandomUser username
           @endforeach           

            </div>

        <div class =profileImage> <!--Artist/ band name Image-->
           
        </div>

        <div class = profileLocation> <!--Username-->


           @foreach ($randomUser as $selectedUser)
           <p> {{ $selectedUser->location}}</p>   Retrieves RandomUser username 
           @endforeach
        </div>

        <div class = promo><!--A video or link that the user wants other to see to attract them to view their profile-->

        </div>


        <div class = UserURL> <!--Link to their profile-->
            <p> Check them out!! -  </p>
        </div>

  
    </div>

<!-- FILL DROPDOWN WITH SPOTIFY GENRE JSON FILE--->

        
       









      
 

            <div class="form-group row">
                     <label for="Select a Genre" class="col-md-4 col-form-label text-md-right">{{ __('Select a genre:') }}</label>
                        <div class="col-md-6">
                            <form method="POST" action="/dailyMusicUpdate" >
                                @csrf 
                                <select name="dailyMusicMatch" id="dailyMusicMatch"  onchange="this.form.submit()" class="form-control input">
                                </select>
                            </form> 
                        </div>
                    </div>









 <script>

            var List;
            jQuery.ajax({
                url: "/json/SpotifyGenres.json",
                type: "POST",
                dataType: "json",
                async: true,
                success: function (data) {
                List = data.genres
                
                    $('#dailyMusicMatch').append('<option value="">Select a genre</option>');
                            $.each(data.genres, function(key, genres){
                            $('#dailyMusicMatch').append('<option>' + genres + '</option>');
                    });
                }
            });
                    
   </script>  






                     
                        </div>
                    </div>


                
              
                                
                            
           
            
                           



                           
                        </div>
                   
                </div>

        
        
                     





<!--include api .blade--> <!-- Can you include a function from a different controller?-->





@endsection
