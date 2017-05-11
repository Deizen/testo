@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Editar Parametro</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<form action="{{url('/actualizarParametro')}}/{{$parametro->id}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
				<label for="nombre">Nombre:</label>
				<input name="nombre" type="text" value="{{$parametro->nombre}}" placeholder="Teclea nombre" class="form-control" required autofocus>
				@if ($errors->has('nombre'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                @endif
			</div>
                        
                        <div class="form-group{{ $errors->has('medida') ? ' has-error' : '' }}">
				<label for="medida">Medida:</label>
				<input name="medida" type="text" value="{{$parametro->medida}}" placeholder="Teclea medida" class="form-control" required autofocus>
				@if ($errors->has('medida'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('medida') }}</strong>
                                        </span>
                                @endif
			</div>

			<button type="submit" class="btn btn-primary">Actualizar</button>
			<a href="{{url('/consultarParametros')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop