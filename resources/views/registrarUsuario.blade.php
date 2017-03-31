@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Registro de Usuario</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
	<div class="col-xs-12">
		<form action="{{url('/guardarUsuario')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name">Nombre:</label>
				<input name="name" type="text" placeholder="Teclea nombre" class="form-control" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email">Email:</label>
				<input name="email" type="email" placeholder="Teclea Email" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
		      <label for="role" >Roles</label><br>
		        <select class="form-control" name="role" id="role">
		          @foreach($roles as $r)
		          <option value="{{$r->name}}">{{$r->name}}</option>
		      	  @endforeach
		        </select>
		    </div>


			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password">Contraseña:</label>
				<input name="password" type="password" placeholder="Teclea contraseña" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="descuento_maximo">Descuento maximo</label>
				<input name="descuento_maximo" type="number" placeholder="Teclea descuento maximo" class="form-control" required>
			</div>

			<button type="submit" class="btn btn-primary">Registrar</button>
			<a href="{{url('/consultarUsuarios')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop