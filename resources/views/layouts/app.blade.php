<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Declaraciones Juradas en Línea</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/libreria.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/satp.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
   
</head>
<body id="app-layout" class="hold-transition skin-blue">
    <div class="wrapper">
        <header id="navigation">
            <div class="navbar navbar-default navbar-static-top" role="banner">
                <div class="col-md-12">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <h1><img height="45" src="{{asset('img/logo.png')}}"></h1>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><h4>SISTEMA DE DECLARACIONES JURADAS EN LÍNEA</h4></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Iniciar sesión</a></li>
                                <li><a href="{{ url('/register') }}">Registrar</a></li>
                                <li><a href="{{ url('/admin/login') }}"><i  class="glyphicon glyphicon-cog" title="Ingresar al módulo de Administración del Sistema"></i></a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <i class="glyphicon glyphicon-{{(Auth::user()->tipoPersona=='1')? 'user':'home'}}"></i>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content_wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    @if(isset($titFormulario))
                                    {{$titFormulario}}
                                    @else
                                    DECLARACIONES JURADAS VIRTUALES
                                    @endif
                                </h3>
                            </div> 
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @yield('content') 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="col-md-12 col-lg-12 bg-primary"><br>
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2014-2020 Servicio de Administración Tributaria de Piura</a>.</strong> All rights reserved.<br><br>
                </div>
            </div>
        </footer>
        
    <!-- JavaScripts -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/libreria.js')}}"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('plugins/datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('plugins/datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('plugins/datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
