<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="/">
    <title>{{env('APP_NAME')}}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
@yield('fonts')
<!-- Styles -->
    <link rel="stylesheet" type="text/css" href="http://localhost:8090/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="http://localhost:8090/css/app.css">
<!-- <link rel="stylesheet" type="text/css" href="{{url('css/vendor.css')}}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}">  -->
    <link rel="stylesheet" type="text/css" href="{{url('css/fontello.css')}}">

    @yield('styles')
</head>
<body>
<div id="particles-js">
    <app-root></app-root>
</div>
</body>
<!-- Scripts -->
<!-- <script src="{{ url('js/vendor.js') }}"></script> -->
<!-- <script src="{{ url('js/app.js') }}"></script> -->
<script src="{{ url('js/particles.min.js') }}"></script>
<script src="http://localhost:8090/webpack-dev-server.js"></script>

<script src="http://localhost:8090/js/vendor.js"></script>
<script src="http://localhost:8090/js/app.js"></script>
<!-- <script src="{{ url('js/videojs-dvrseekbar.min.js') }}"></script> -->
</html>
