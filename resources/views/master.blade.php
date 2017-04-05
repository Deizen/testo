<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AdminLC</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{url('/')}}"><b>AdminLC</b</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      @hasrole('admin')
	      <li><a href="{{url('consultarUsuarios')}}">Usuarios</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogos<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="{{url('editarEmpresa')}}">Configuracion de empresa</a></li>
	            <li><a href="{{url('consultarSucursales')}}">Sucursales</a></li>
	            <li><a href="{{url('consultarClientes')}}">Clientes</a></li>
	            <li><a href="{{url('consultarCajas')}}">Cajas</a></li>
	          </ul>
	        </li>
	      @endhasrole
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Ingresar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Desconectar
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
	    </div>
	  </div>
	</nav>
	<div class='container'>
		@yield('titulo')
		@yield('contenido')
	</div>
	<footer class="text-center">
		<hr>
		AdminLC &copy; 2017
	</footer>
	<script src="{{asset("js/jquery-3.1.1.js")}}"></script>
	<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
