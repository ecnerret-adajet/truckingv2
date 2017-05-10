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


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>



    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
</head>
<body>

    <div class="wrapper" id="app">

    <div class="sidebar" data-color="azure" data-image="{{asset('/img/sidebar-2.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/home')}}" class="simple-text">
                    Trucking Monitoring
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{url('/home')}}">
                        <i class="pe-7s-edit"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/drivers')}}">
                    <i class="pe-7s-id"></i>
                        <p>Drivers</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/trucks')}}">
                        <i class="pe-7s-helm"></i>
                        <p>Trucks</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/haulers')}}">
                        <i class="pe-7s-box2"></i>
                        <p>Haulers</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/users')}}">
                        <i class="pe-7s-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/feed')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Live Feed</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/systemlog')}}">
                        <i class="pe-7s-clock"></i>
                        <p>Logs</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
  <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- <p style="vertical-align: middle;"> 
                            <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 30px;">
                            
                            </p> -->
                                <p>
                                {{ Auth::user()->name }}
                                 <b class="caret"></b>
                                </p>
                                
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
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
                @yield('content')
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                La Filipina Uy Gongco Group of Companies
                </p>
            </div>
        </footer>

    </div>





</div>
    



    <!-- Scripts -->
   
    <script src="{{ asset('js/all.js') }}"></script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="{{asset('js/morris-report.js')}}"></script> --}}



   


</body>
</html>
