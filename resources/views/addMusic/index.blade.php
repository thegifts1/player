@extends('layouts.base')

@section('title', 'Add Music')

@section('content')
    @guest
        {{ __('Log in first') }}
    @endguest

    @auth
        @if ($errors->any())
            {{ $errors }}
        @endif

        <section>
            <div class="addMusic">
                <label>{{ __('Select Files:') }}</label>
                <form method="POST" action="{{ route('addMusic.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input class="input" type="file" name="fileUpload[]" multiple>
                    <p class="submit"><input type="submit" name="commit" value="{{ __('Upload') }}"></p>
                </form>
            </div>
        </section>

        @section('addMusic.css')
            @vite(['resources/css/addMusic.css'])
        @endsection
    @endauth
@endsection
