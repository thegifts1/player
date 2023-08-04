<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <link rel="icon" href="img/svg/headphones.svg" type="image/svg+xml">

    @yield('plyr.css')
    @yield('loginRegister.css')
    @yield('addMusic.css')

    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="container-main">
        @include('includes.header')

        <main class="main">
            @yield('content')
        </main>

        @include('includes.footer')
    </div>

    @vite(['resources/js/app.js'])
    
    @yield('plyr.js')
    @yield('js')
</body>

</html>
