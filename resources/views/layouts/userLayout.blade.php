<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest cdn CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!--Cdn Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!--Nav bar-->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="#">DiscoverMusic   </a> 
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <!--This is the left side of the Navbar-->
        <ul class="nav navbar-nav">
         @if (Route::has('login'))
         @auth
          <li class="active"><a href="/dashboard">Home</a></li>
          <li><a href="{{ url('/profile') }}">Profile</a></li>
          <li><a href="{{ url('/dailyMusic') }}">Daily Music</a></li>
          <li><a href="{{ url('logout') }}">Log out</a></li>
        </ul>
         <!--This is the right side of the Navbar--> <
        @endauth
     <!--This is the right side of the Navbar--> <!--Still can see login + signup FIX-->
      @endif
            </div>
        </div>
    </nav>
</head>

<body>
  
@yield('content')

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>