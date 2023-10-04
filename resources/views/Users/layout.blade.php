<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>App Name - @yield('title')</title>
    </head>
    <body class="h-screen bg-blue-50 sans-serif">

        @include('components.header')

        <div class="p-4">   
            @yield('home')
            @yield('interviewPage')
            @yield('feedback')
        </div>

    </body>
</html>