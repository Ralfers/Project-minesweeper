<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Minesweeper</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/minesweeper.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/minesweeper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/show_scores.css') }}" rel="stylesheet">
    <style>
        .mr-auto li a{
            text-decoration: none;
            color: grey;
            padding-left: 10px;
        }
        .padded-content {
            width:1000px;
            margin:0 auto;
            border-radius: 2px;
            border-style: solid;
            border-color: rgba(192,192,192,50);
            border-width: 2px;
            padding: 14px;
        }
        .user-content {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div id="app">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Minesweeper Online!
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a href="{{ url('/game') }}">@lang('layout.Random') | </a>
                        </li>
                        <li>
                            <a href="{{ url('/daily') }}">@lang('layout.Daily') | </a>
                        </li>
                        <li>
                            <a href="{{ url('/scores') }}">@lang('layout.Scores') | </a>
                        </li>
                        <li>
                            <a href="{{ url('/users') }}">@lang('layout.Find') | </a>
                        </li>
                        <li>
                            <a href="{{ url('/seed') }}">@lang('layout.Seed')</a>
                        </li>
                        <li>
                            @if(Auth::user())
                                <a href="{{ url('/users/'.Auth::user()->id) }}"> | @lang('layout.Profile')</a>
                            @endif
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('auth.Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('auth.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <ul class="language-change">
                        <a href="javascript:;" onclick="changeLang('en')" class="language-link">en</a>
                        <a href="javascript:;" onclick="changeLang('lv')" class="language-link">lv</a>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="padded-content">
                @yield('content')
            </div>
        </main>
    </div>
</body>

<script>

    function changeLang(lang)
    {
        
        console.log(lang);

        window.location = '/locale?lang='+lang;
        //location.reload();
    }
</script>

</html>
