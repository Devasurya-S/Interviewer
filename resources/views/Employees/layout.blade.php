<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>App Name - @yield('title')</title>
    </head>
    <body class="h-screen bg-blue-50 sans-seri">

        @include('components.header')

        <div class="flex">
            @section('sidebar')
                @include('components.sidebar')
            @show
     
            @yield('answerGroups')
            @yield('interviewGroups')
            @yield('addInterview')
            @yield('candidateGroups')
            @yield('addCandidate')
            @yield('candidates')
            @yield('candidateUpdate')
            @yield('interviewUpdate')
            @yield('candidateAnswers')
            @yield('answerView')
  
        </div>

    </body>
</html>