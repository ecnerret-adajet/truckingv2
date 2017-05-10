<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">



    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
    html,body{
        height: 100%;
        background-color: #f6f9fc;
    }
    body {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .control-label{
        text-align: left ! important;
    }
    h5{
        font-weight: bold;
        border-bottom: 1px solid #f6f9fc;
        padding-bottom: 20px;
        letter-spacing: 0.5px;

    }
    .panel{

            box-shadow: 0 0 0 1px rgba(14,41,57,.12), 0 2px 5px rgba(14,41,57,.44), inset 0 -1px 2px rgba(14,41,57,.15);
            background: linear-gradient(#fff,#f2f6f9);
            border: 1px solid #f2f6f9;
    }
    label{
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
    }
    .logo-title{
        padding-top: 30px;
    }
    .logo-title span {
        font-size: 18px;
        font-weight: bold;
    }
  

    </style>
</head>
<body>
  

        @yield('content')


    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
