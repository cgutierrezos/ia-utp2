<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width" user-scalable="no" initial-scale="1.0" maximum-scale="1.0" minimum-scale="1.0">
        <title> @yield('title') </title>
        
    </head>
    <body id="body">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
        <script src=" {{ asset('plugins/jquery/js/jquery-3.1.1.js') }}"></script>
        <script src=" {{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
        @include('templates.nav')
        <p>
            
        </p>
        @yield('body')
    </body>
</html>
