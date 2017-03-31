@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Registro de Caja</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<form action="{{url('/guardarCaja')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
				<label for="nombre">Nombre:</label>
				<input name="nombre" type="text" placeholder="Teclea nombre" class="form-control" required autofocus>
				@if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
		      <label for="role" >Sucursales</label><br>
		        <select class="form-control" name="sucursal" id="sucursal">
		          @foreach($sucursales as $s)
		          <option value="{{$s->nombre}}">{{$s->nombre}}</option>
		      	  @endforeach
		        </select>
		    </div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="efectivo_maximo">Limite de efectivo:</label>
				<input name="efectivo_maximo" type="number" placeholder="Teclea limite de efectivo" class="form-control" required>
                @if ($errors->has('efectivo_maximo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('efectivo_maximo') }}</strong>
                    </span>
                @endif
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