@extends('index')

@section('content')
    <h1 class="cover-heading d-flex align-items-center justify-content-center">
        <img class="mr-2" src="{{ asset('logo.png') }}" width="55">
        {{ config('app.name', 'Laravel') }}
    </h1>
    <p class="lead">
        {{ __('This financial application was created to explore the possibilities of working with the Laravel framework.') }} 
        {{ __('The application implements the simplest functions allowing you to make a deferred transfer of funds from your accounts to the account of the selected user.') }}
        <br/>
        {{ __('All operations are carried out in your Personal Area.') }}
    </p>
    @guest  
        <p class="lead">{{ __('You must be registered to use the application.') }}</p>
    @endguest
    <p class="lead">
        @auth
            <a class="btn btn-lg btn-secondary" href="{{ route('home') }}">{{ __('Go to your Personal Area') }}</a>
        @else
            <a class="btn btn-lg btn-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>

            <a class="btn btn-lg btn-secondary" href="{{ route('register') }}">{{ __('Sign up') }}</a>
        @endauth
    </p>
@endsection