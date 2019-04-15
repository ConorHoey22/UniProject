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

 <link href="/css/design.css" rel="stylesheet" type="text/css">



   <!--Icons-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    

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
    
  
      
      <!--This is the right side of the Navbar--> <!--Still can see login + signup FIX-->
      @endauth
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

@include('include.errorMessage')


@yield('content')




<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

<footer class="container-fluid text-center">
  <p>DiscoverMusic</p>
</footer>

</html>