@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Registro de Examen</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<form action="{{url('/guardarSucursal')}}" method="POST">
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

		
			<div class="form-group{{ $errors->has('parametro') ? ' has-error' : '' }}">
				<label for="parametro">Agregar Parametros:</label>
				<input name="parametro" type="text" placeholder="Asigna parametros" class="form-control" required autofocus>
				<span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
				@if ($errors->has('telefono'))
                    <span class="help-block">
                        <strong>{{ $errors->first('parametro') }}</strong>
                    </span>
                @endif
			</div>

			<!--
<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Custom search field</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Buscar" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>	
-->



			<button type="submit" class="btn btn-primary">Registrar</button>
			<a href="{{url('/consultarSucursales')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop