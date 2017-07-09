<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trucking Monitoring') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
     <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('top-script')
    
</head>
<body>
    <div class="wrapper" id="app">


  <div class="main-panel">


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="img-responsive" src="{{asset('/img/trucking_monitoring.png')}}" style="display: block; vertical-align: middle; height: 100%;">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <ul class="nav navbar-nav">

    @role((['Administrator','Monitoring']))

        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{url('/home')}}">Dashboard</a></li>
        <li class="dropdown {{ (
            Request::is('summary') || Request::is('generate*') ||
            Request::is('daily') || Request::is('monitors/*'))? 'active' : '' }}"><a href="" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
               <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('/summary') }}"> Daily Report </a>
                        <a href="{{ url('/daily') }}"> Search Daily Logs </a>
                    </li>
                </ul>
        
        </li>

        <li class="{{ (
            Request::is('manage') || 
            Request::is('drivers') || Request::is('drivers/*') ||
            Request::is('trucks') || Request::is('trucks/*') ||
            Request::is('haulers') || Request::is('haulers/*'))
        ? 'active' : '' }}"><a href="{{ url('/manage')  }}">Manage Fields</a></li>
        <li class="{{ Request::is('users') ? 'active' : '' }}"><a href="{{ url('/users') }}">Users</a></li>

    @endrole

        <li class="{{ Request::is('feed') ? 'active' : '' }}"><a href="{{ url('/feed') }}"><i class="fa fa-circle" aria-hidden="true"></i>  <span class="hidden-sx" >Live Feed</span> </a></li>

      </ul>


      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">                            
                Hello, {{ Auth::user()->name }}
                    <b class="caret"></b>
                
            </a>
            <ul class="dropdown-menu">
                <li>
                <a href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">         
                    Logout
                </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
            </form>
                </li>
            </ul>
        </li>
      </ul>



    </div>
  </div>
</nav>


        <div class="container-fluid">
                @yield('content')
        </div>

       


        {{-- <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                </nav>
                <p class="copyright pull-right">
                La Filipina Uy Gongco Group of Companies
                </p>
            </div>
        </footer> --}}

    </div>





</div>



    <!-- Scripts -->
    
   
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

        <script type="text/javascript">
            (function() {

                [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
    </script>

    @yield('script')

</body>
</html>
