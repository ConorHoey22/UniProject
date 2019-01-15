@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                   <div class="card-body">

                     <!--Beginning of the Register Form - Values entered are sent to the RegisterController-->
                    <form method="POST" action="{{ route('postsignup') }}">
                        @csrf
                        <!--Username-->
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

                        <!--Email-->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <!--User Validatin-->
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Password-->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <!--User Validation-->
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--Confirm password-->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!--Country-->
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text"  name="country" class= "form-control" required autofocus>
                            </div>
                        </div>

                        <!--Location-->
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Town/City:') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text"  name="location" class= "form-control" required autofocus>
                            </div>
                        </div>   

                        <!--UserTypes-->
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

                    <!--Genre - Used for Profile Content-->
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
  
                    <!--Description - Used for Profile Content-->
                     <div class="form-group row">
                            <label for="profileDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label>
                            <div class="col-md-6">
                                <input id="profileDescription" type="text"  name="profileDescription" class= "form-control" required autofocus>
                            </div>
                    </div>


                



                     <!--SoundCloud Widget--   Not required --->
                     <div class="form-group row">

                            <label for="soundCloudWidget" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
                            <div class="col-md-6">
                                <input id="soundCloudWidget" type="text"  name="soundCloudWidget" class= "form-control">
                            </div>


                            <div class = howToGuide>
                                <p> This is the creditionals you need to enter to obtain your soundCloudID</p>
                            </div>



                            

                    </div>



                     <!--SoundCloud Logo which link to your profile--   Not required -->
                     <div class="form-group row">

                            <label for="soundCloudProfile" class="col-md-4 col-form-label text-md-right">{{ __('Attach your SoundCloud Details:') }}</label>
                            <div class="col-md-6">
                                <input id="soundCloudProfile" type="text"  name="soundCloudProfile" class= "form-control">
                            </div>
                    </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection