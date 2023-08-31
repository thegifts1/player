@extends('layouts.base')

@section('title', 'Login')

@section('content')
    @if ($errors->any())
        {{ $errors }}
    @endif

    <section class="container">
        <div class="login">
            <h1>{{ __('Login to your account') }}</h1>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <p><input type="text" name="name" placeholder="{{ __('Name') }}"></p>
                <p><input type="password" name="password" placeholder="{{ __('Password') }}"></p>
                <p class="remember_me">
                    <label>
                        <input type="checkbox" name="remember" id="remember">
                        {{ __('Remember me') }}
                    </label>
                </p>
                <p class="submit"><input type="submit" name="commit" value="{{ __('Login') }}"></p>
            </form>
        </div>

        <div class="login_help">
            <a class="login_help_link" href="#">{{ __('Forgot your password?') }}</a>
        </div>
    </section>
@endsection
