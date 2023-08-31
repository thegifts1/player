@extends('layouts.base')

@section('title', 'Settings')

@section('content')
    @guest
        {{ __('Log in first') }}
    @endguest

    @auth
        <form action="{{ route('settings.changeThemeForAuth') }}" method="POST">
            @csrf
            <input type="checkbox" name="darkTheme" id="darkTheme"> {{ __('Use dark theme') }}
            <p class="submit"><input type="submit" name="commit" value="{{ __('Save') }}"></p>
        </form>

        <form action="{{ route('settings.changeLangForAuth') }}" method="POST">
            @csrf
            <p class="submit"><input type="submit" name="lang" value="{{ __('Rus') }}"></p>
        </form>
        <form action="{{ route('settings.changeLangForAuth') }}" method="POST">
            @csrf
            <p class="submit"><input type="submit" name="lang" value="{{ __('Eng') }}"></p>
        </form>
    @endauth
@endsection
