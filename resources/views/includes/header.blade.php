<header>
    <div>
        <a href="{{ route('music.index') }}" class="logo">{{ __('Music') }}</a>
        <a href="{{ route('addMusic.index') }}">{{ __('Add Music') }}</a>
    </div>
    <nav>
        <a href="{{ route('home.index') }}">{{ __('Home') }}</a>
        @auth
            {{ Auth::user()->name }}
            <a href="{{ route('logout.store') }}">{{ __('Logout') }}</a>
        @endauth

        @guest
            <a href="{{ route('register.index') }}">{{ __('Registration') }}</a>
            <a href="{{ route('login.index') }}">{{ __('Login') }}</a>
        @endguest
    </nav>
</header>
