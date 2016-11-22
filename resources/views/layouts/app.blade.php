<!DOCTYPE HTML>
<!--
    Landed by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('plugins/landed/css/main.css') }}">
        
    </head>
    <body>
        <div id="page-wrapper">

            @include('templates.nav2')

            <div id='main' class='wrapper style1'>
                <div class='container'>
                    @yield('body')
                </div>
            </div>
        </div>
        
        
        <script src="{{ asset('plugins/landed/js/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/jquery.scrolly.min.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/jquery.dropotron.min.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/jquery.scrollex.min.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/skel.min.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/util.js') }}"></script>
        <script src="{{ asset('plugins/landed/js/main.js') }}"></script>

    </body>
</html>