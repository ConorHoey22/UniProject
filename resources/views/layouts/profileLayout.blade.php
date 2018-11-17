<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

   
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">DiscoverMusic   </a> <!--Still need to link this--> 
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

    <!--This is the left side of the Navbar-->
      <ul class="nav navbar-nav">
      @if (Route::has('login'))
      @auth
        <li class="active"><a href="#">Home</a></li>
        <li><a href="{{ url('/profile') }}">Profile</a></li>
        <li><a href="{{ url('/dailyMusic') }}">Daily Music</a></li>
        <li><a href="{{ url('logout') }}">Log out</a></li>
      </ul>
      <!--This is the right side of the Navbar--> <!--Still can see login + signup FIX-->
      @endauth
      <ul class= "nav navbar-nav right">
        <li><a href="{{ url('register') }}">Sign Up</a></li>
        <li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
      @endif
    </div>
  </div>
</nav>





</head>

<!--THIS CONTAINS THE NAVBAR-->

<body>

@yield('content')







<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>