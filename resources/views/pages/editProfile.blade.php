@extends('layouts.userLayout')

@section('content')


<div class = "container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                 <div class="card-body">

              <div class = editUsername>
                      <form method="POST" action="{{ route('register') }}">
                         @csrf
                        
                            <div class="form-group row">
                                
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                </div>

                            </div>
                      
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update Username') }}
                                            </button>
                                        </div>
                                    </div>
                      </form>
              </div>


                          

                            
                            <div class = editUserType>

                            </div>

                            <div class = editCountry>

                            </div>

                            <div class = editLocation>

                            </div>

                            <div class = editPreferredGenre>

                            </div>

                            <!--Only seen by UserType Artist/Band only-->
                            <div class = editArtistBandGenre>

                            </div>

                            <!--Only seen by UserType Artist/Band only-->
                            <div class = editPromo>

                            </div>

                            <!--Only seen by UserType Artist/Band only-->
                            <div class = editSpotify>

                            </div>

                            <!--Only seen by UserType Artist/Band only-->
                            <div class = editSoundCloud>

                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection