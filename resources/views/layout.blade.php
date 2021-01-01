<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Scorecard Tracker</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body>
            <header>
                <span class="helper"></span>
                <a href="/scorecards"><img height=100vh src="{{URL('/images/logo.png')}}"></a>
                <div class="header-right">
                        <a href="/advancedstats">Advanced Stats</a>
                        <a> by Jack Emond </a>
                </div>
            </header>
            <main>
            
                @yield('content')
            
        </main>
    </body>
</html>
