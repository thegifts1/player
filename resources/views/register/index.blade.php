@extends('layouts.base')

@section('title', 'Register')

@section('content')
    @if ($errors->any())
        {{ $errors }}
    @endif

    <section class="container">
        <div class="login">
            <h1>{{ __('Register') }}</h1>
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <p><input type="text" name="name" placeholder="{{ __('Name') }}"></p>
                <p><input type="text" name="email" placeholder="{{ __('Email') }}"></p>
                <p><input type="password" name="password" placeholder="{{ __('Password') }}"></p>
                <p><input type="password" name="password_confirmation" placeholder="{{ __('Confirm password') }}"></p>
                <p class="remember_me">
                    <label>
                        <input type="checkbox" name="remember" id="remember">
                        {{ __('Remember me') }}
                    </label>
                </p>
                <p class="submit"><input type="submit" name="commit" value="{{ __('Register') }}"></p>
            </form>
        </div>
    </section>
@endsection
