<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--Estilos-->
    <link href="{{ asset('css/estilo-login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inicioadmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo-usuarios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo-agregarusuario.css') }}" rel="stylesheet">

    <link href="{{ asset('css/productos.css') }}" rel="stylesheet">


    <!-- Bootstrap y Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- GRAFICAS-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.stream', 'Family Dx') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth()
                        <ul class="navbar-nav mr-auto">

                            @can('seller.home')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/productossellerb') }}" class="nav-link">Productos Buscador</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/solicitudes') }}" class="nav-link">Solicitudes</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/productossolicitados') }}" class="nav-link">solicitar producto</a>
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

                        <!-- Productos -->



                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item">
                                    ("home")
                                </a>
                                <a class="dropdown-item" href="{{ url('/home') }}">
                                    {{ __('home') }}
                                </a>

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
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#exampleModal').modal('hide');
        });
        window.livewire.on('closeModalUpdate', () => {
            $('#updateModall').modal('hide');
        });
        window.livewire.on('closeupdateModal', () => {
            $('#updateModal').modal('hide');
        });
    </script>
    <script src="{{ asset('js/estilo-login.js') }}"></script>
    <script src="{{ asset('js/inicioadmin.js') }}"></script>
</body>

</html>