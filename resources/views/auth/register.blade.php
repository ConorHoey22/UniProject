@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
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

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                 <!--NOTE : This dropdown needs to be prepopulated through a json file? or an input-->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text"  name="country" class= "form-control" required autofocus>
                            </div>
                        </div>

                          
                 <!--NOTE : This dropdown needs to be prepopulated through a json file? or an input-->
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Town/City:') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text"  name="location" class= "form-control" required autofocus>
                            </div>
                        </div>   

                    <div class="form-group row">
                     <label for="userType" class="col-md-4 col-form-label text-md-right">{{ __('Type of user:') }}</label>
                        <div class="col-md-6">
                              <select name = "userType"  class="form-control input">
                                  <option value="Listener">Listener</option>
                                  <option value="Artist">Artist</option>
                                  <option value="Band">Band</option>
                              </select>
                        </div>
                    </div>

                    <!--NOTE : This dropdown needs to be prepopulated through a json file? or an input-->
                     <div class="form-group row">
                     <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Please select a genre of music in which you enjoy listening which will help us send you a random song everyday:') }}</label>
                   
                        <div class="col-md-6">
                              <select name = "genre"  class="form-control input">
                                  <option value="Pop">Pop</option>
                                  <option value="Rock">Rock</option>
                                  <option value="Folk">Folk</option>
                              </select>
                        </div>
                    </div>


                    <!--IF USERTYPE == Artist or Band-->


                    <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="connectSpotifyAPI()">
                                    {{ __('Connect Spotify') }}
                        

                                </button>
                          </div>
                    </div>

                     <!--NOTE : This dropdown needs to be prepopulated through a json file? or an input-->
                     <div class="form-group row">
                            <label for="profileDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label>

                            <div class="col-md-6">
                                <input id="profileDescription" type="text"  name="profileDescription" class= "form-control" required autofocus>
                            </div>
                        </div>



                    <div class = connectSpotify>
                        <label for="connectSpotify" class="col-md-4 col-form-label text-md-right">{{ __('Connect your Spotify:') }}</label>
                    </div>


                    <div class = connectSoundCloud>
                        <label for="connectSoundCloud" class="col-md-4 col-form-label text-md-right">{{ __('Connect your SoundCloud:') }}</label>
                    </div>


                    <div class = connectFacebook>
                         <label for="connectFacebook" class="col-md-4 col-form-label text-md-right">{{ __('Connect your Facebook:') }}</label>
                    </div>

                    <div class = connectTwitter>
                        <label for="connectTwitter" class="col-md-4 col-form-label text-md-right">{{ __('Connect your Twitter:') }}</label>
                    </div>

                    <div class = connectInstagram>
                        <label for="connectInstagram" class="col-md-4 col-form-label text-md-right">{{ __('Connect your Instagram:') }}</label>
                    </div>


<iframe src="https://open.spotify.com/embed/album/3EhZIuxBiEh6yCkosURDQ3" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

<p>If your on mobile setting up your account for spotify 




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection