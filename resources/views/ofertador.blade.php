@extends('layouts.app')
@section('title', __('Welcome1'))
@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>
    </head>
<body>
    <div class="app">

        <div class="container">



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth()
                    <ul class="navbar-nav mr-auto">
                        @can('seller.home')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Inicio</a>
                        </li>
                        @endcan


                    </ul>
            @endauth()

            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <!--
                            Boton de entrar
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        -->
                    @endif

                    @if (Route::has('register'))
                        <!--
                            BOTON DE REGISTRAR
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        -->
                        @endif
                    @else




                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can("seller.home")
                                    <a class="dropdown-item" href="{{ url('/home') }}" >
                                        {{ __('home') }}
                                    </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

    </div>

</body>
@endsection
