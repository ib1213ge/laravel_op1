<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">


    <!-- Styles -->
    @if(app('env') == 'production')
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/animation.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/mypage.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
    @endif

    <!-- Icon -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
               @guest
                <a class="navbar-brand" href="{{ url('/timers') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
               @else
                <a class="navbar-brand" href="{{ url('/mypage') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
               @endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item pt-2">
                                <a class="nav-link text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-right" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item pt-2">
                                <a class="nav-link text-right" href="{{ route('timers.mypage') }}">{{ __('Mypage') }}</a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-right" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- フラッシュメッセージ -->
        @if(session('flash_message'))
            <div class="alert alert_primary text-center" role="alert">
                {{ session('flash_message') }}
            </div>
        @endif

        <main>
            @yield('content')
        </main>

    </div>
</body>
</html>
