@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Agregar Paciente</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
	<form action="{{url('/guardarPaciente')}}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="nombre">Nombre:</label>
			<input name="nombre" type="text" placeholder="Teclee nombre" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="apellido_P">Apellido Paterno:</label>
			<input name="apellido_P" type="text" placeholder="Teclee apellido" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="apellido_M">Apellido Materno:</label>
			<input name="apellido_M" type="text" placeholder="Teclee apellido" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="sexo">Sexo:</label>
			<select name="sexo" class="form-control" required autofocus>
				<option value="" selected>Seleccione Sexo</option>
				<option value="Femenino">Femenino</option>
				<option value="Masculino">Masculino</option>
			</select>
		</div>
		<div class="form-group">
			<label for="fecha_Nac">Fecha de Nacimiento:</label>
			<br>
			<select name="dia" class="form-control" required autofocus style="width: 70px; display: inline-block;">
				<option value="" selected>Dia</option>
					@for($i=1; $i<=31; $i++)
					{
						<option value="{{ $i}}">{{$i}}</option>
					}
					@endfor
			</select>
			<select name="mes" class="form-control" required autofocus style="width: 140px; display: inline-block;">
				<option value="" selected>Mes</option>
				<option value="1">Enero</option>
				<option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
			</select>
			<select name="año" class="form-control" required autofocus style="width: 85px; display: inline-block;">
			<option value="" selected>Año</option>
				@for($i=1910; $i<=2017; $i++)
				{
					<option value="{{ $i}}">{{$i}}</option>
				}
				@endfor
			</select>
		</div>
		<div class="form-group">
			<label for="telefono">Telefono:</label>
			<input name="telefono" type="text" placeholder="Teclee Telefono" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input name="email" type="email" placeholder="Teclee E-mail" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="direccion">Direccion:</label>
			<input name="direccion" type="text" placeholder="Teclee Direccion" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="estado">Estado:</label>
			<input name="estado" type="text" placeholder="Teclee Estado" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="municipio">Municipio:</label>
			<input name="municipio" type="text" placeholder="Teclee Municipio" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="localidad">Localidad:</label>
			<input name="localidad" type="text" placeholder="Teclee Localidad" class="form-control" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary">Registrar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</form>
</div>
@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop