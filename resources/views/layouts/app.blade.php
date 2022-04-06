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
    <!-- <link href="{{ asset('css/iniciousers.css') }}" rel="stylesheet"> -->

    <!-- Bootstrap y Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg">
            <div class="container">
                <a class="float-left" >
                    {{ config('app.stream', 'FamilyBenefits')  }}
                    
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @auth()
                    <ul class="navbar-nav mr-auto">
                        @can('admin.home')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/Dashboard') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/productos') }}" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/usuarios') }}">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/Categorias') }}">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/Municipios') }}">Municipios</a>
                        </li>
                        @endcan
                        @can('seller.home')
                        <li class="nav-item">
                            <a href="{{ url('/productosseller') }}" class="nav-link"> Mis productos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/productossellerb') }}" class="nav-link">Buscar productos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/solicitudes') }}" class="nav-link">Mis amigos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/detallesdelproducto') }}" class="nav-link">Detalles de mis prestamos</a>
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
                        
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                
                            <i class="far fa-bell"></i>
                            
                                @if (count(auth()->user()->unreadNotifications))
                                <span class="badge badge-warning">
                                    {{count(auth()->user()->unreadNotifications)}}
                                </span>
                                    
                                @endif
                            
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="alertsDropdown">
                                	<h6 class="dropdown-header">
                                		Centro de notificaciones
                                	</h6>
                                	@forelse (auth()->user()->unreadNotifications as $notification)
                                	<a class="dropdown-item d-flex align-items-center" href="{{ url('/solicitudes') }}">                                

                                		<div>
                                			<span class="font-weight-bold">Te ha enviado una solicitud de amistad</span>
                                			<div class="small text-gray-500"> <strong><i class="far fa-clock"></i></strong> {{$notification->created_at->diffForHumans()}}</div>
                                			<div class="small text-gray-500"> <strong><i class="fas fa-user-plus"></i></strong> {{$notification->data['name']}}</div>
                                			<div class="small text-gray-500"> <strong><i class="fab fa-facebook-messenger"></i></strong> {{$notification->data['Mensaje']}}</div>
                                		</div>
                                	</a>
                                	@empty
                                	<a class="dropdown-item d-flex align-items-center" href="#">
                                		<div>
                                			<span class="font-weight-bold">Sin notificaciones nuevas</span>
                                		</div>
                                	</a>
                                	@endforelse
                                	<a class="dropdown-item text-center small text-gray-500" href="{{route('marcar')}}">Marcar como leidas</a>
                            </div>
                        </li>

                        <!-- Productos -->



                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item">
                                    
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
        window.livewire.on('closeModalsendRequestProduct', () => {
            $('#SendRequestModal').modal('hide');
            Swal.fire({
            icon: 'success',
            title: 'Registro correcto',
            text: 'Espera a que el ofertador acepte el prestamo'
            
            })
        });
    </script>
    <script src="{{ asset('js/estilo-login.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/inicioadmin.js') }}"></script>
    <!-- GRAFICAS-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>
