<!doctype html>
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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth()
                        <li class="nav-item{{request()->url() == route('pan.create')?' active':''}}">
                            <a class="nav-link" href="{{route('pan.create')}}">Register a PAN</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('device.create')?' active':''}}">
                            <a class="nav-link" href="{{route('device.create')}}">Add a Device</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('digitized_card.create')?' active':''}}">
                            <a class="nav-link" href="{{route('digitized_card.create')}}">Invoke a Digital Card</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('payment.create')?' active':''}}">
                            <a class="nav-link" href="{{route('payment.create')}}">Pay !</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ml-auto">
                    @auth()
                        <li class="nav-item{{request()->url() == route('pan.index')?' active':''}}">
                            <a class="nav-link" href="{{route('pan.index')}}">My PANs</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('device.index')?' active':''}}">
                            <a class="nav-link" href="{{route('device.index')}}">My Devices</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('digitized_card.index')?' active':''}}">
                            <a class="nav-link" href="{{route('digitized_card.index')}}">My Digital Cards</a>
                        </li>
                        <li class="nav-item{{request()->url() == route('payment.index')?' active':''}}">
                            <a class="nav-link" href="{{route('payment.index')}}">My Payments</a>
                        </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
