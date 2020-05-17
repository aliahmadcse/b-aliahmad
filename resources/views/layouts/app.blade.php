<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Home')</title>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-gray" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active':'' }}">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item {{ request()->is('projects') ? 'active':'' }}">
                                <a class="nav-link" href="{{ route('projects.index') }}">Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>

</html>