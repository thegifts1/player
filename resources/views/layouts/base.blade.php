<!DOCTYPE html>
@guest
    @php
        $guest_ip = $_SERVER['REMOTE_ADDR'];
        $guest = App\Models\Guest::query()
            ->where('ip_adress', "$guest_ip")
            ->get(['darkTheme', 'lang']);
    @endphp
    
    <html lang="{{ $guest[0]["lang"] }}">
@endguest

@auth
    <html lang="{{ Auth::user()->lang }}">
@endauth

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <link rel="icon" href="img/svg/headphones.svg" type="image/svg+xml">

    @yield('plyr.css')

    @guest
        @if ($guest[0]['darkTheme'] == 1)
            @vite(['resources/css/darkTheme.css'])
        @else
            @vite(['resources/css/lightTheme.css'])
        @endif
    @endguest

    @auth
        @if (Auth::user()->darkTheme == 1)
            @vite(['resources/css/darkTheme.css'])
        @else
            @vite(['resources/css/lightTheme.css'])
        @endif
    @endauth

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
    @yield('js.header')
</body>

</html>
