@extends('layouts.userLayout')

@section('content')

<link href="/css/design.css" rel="stylesheet" type="text/css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Dashboard') }}</div>
                    <br>

                    <div class="card-body">
                       
                        <div class="recommendationsWords">

                            <p>We recommend you to check out!</p>
                                
                                <div class = "recommendedArtistByWords">
                                
                                  <p>Artist based on the recommendation words, you chose</p>
                             
                                  

                                            <caption>Recommendated Artist based on your requested words</caption>
                                           
                                        
                                    @foreach ($recommendationArtistWordsQuery as $selectedUser)

                            
                                        <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p class="overflow-visible"> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                               
                                                <td><p class="overflow-visible"> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td><p class="overflow-visible"> Description: {{ $selectedUser->profileDescription }} </p>  <!-- Profile Description--></td>
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                    </div>
                     
                                           
                                    @endforeach   
                                        </div>

                                    </div>
                                </div>


                                <div class = "recommendedBandByWords">
                                Band based on the recommendation words, you chose

                                    @foreach ($recommendationBandWordsQuery as $selectedUser)
            

                                    <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                         
                                                <td><p> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td><p> Description: {{ $selectedUser->profileDescription }} </p>  <!-- Profile Description--></td>
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                         </div>

                                    @endforeach   

                                </div>
                                     
                           
                            <button>Edit Recommentdation</button>


                        </div>

                      
                        </div>


                        <div class = "genreMatch">

                        <p>Genre Match</p>

                            @foreach ($genreMatch as $selectedUser)

                            <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p class="overflow-visible"> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                               
                                                <td><p class="overflow-visible"> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td><p class="overflow-visible"> Description: {{ $selectedUser->profileDescription }} </p>  <!-- Profile Description--></td>
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                    </div>
                     
                            @endforeach   

                        </div>




                        
                        <div class = "following">

                        <p>Currently Following</p>

                            @foreach ($following as $selectedUser)

                            <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p class="overflow-visible"> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                               
                                                <td><p class="overflow-visible"> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td><p class="overflow-visible"> Description: {{ $selectedUser->profileDescription }} </p>  <!-- Profile Description--></td>
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                    </div>
                     
                            @endforeach   

                        </div>
                        


                        <div class = "randomArtistUser">

                        <p>Random Artist </p>

                            @foreach ($randomArtistUser as $selectedUser)
                        
                                

                                    <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                     
                                                <td><p> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td><p> Description: {{ $selectedUser->profileDescription }} </p>  <!-- Age(Band) --></td>
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                    </div>
                            @endforeach   

                        </div>


                        <div class = "randomBandUser">

                        <p>Random Band </p>

                            @foreach ($randomBandUser as $selectedUser)
                        
                                    <div class="table-responsive-md">
                                            <table class= "table">
                                            <tbody>
                                                <tr>
                                                <td> <p> {{ $selectedUser->username}}</p>  <!-- Username--></td>
                                                <td><img class="img-rounded" src= "/storage/images/{{ $selectedUser->image }}" width=70/></td> <!-- IF COndition - no image found-->
                                        
                                                <td><p> Genre: {{ $selectedUser->genre }} </p>  <!-- Genre--></td>
                                                <td> Description: <p>{{ $selectedUser->profileDescription }} </p></td><!-- Profile Description-->
                                                <td> 
                                                <button type="button" class="btn btn-success">
                                                <i class="fas fa-user-circle"></i> <br><a href="{{ route('user.profile', $selectedUser->username) }}">View Profile</a>
                                                </button>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        
 
                                    </div>

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
