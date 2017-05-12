<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de Pacientes</title>
	<link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
	
</head>
<body>
	<h1>Lista de Pacientes</h1>
	<hr>
	<table class="table table-striped table-hovers">
	<thead>
		<tr class="info">
			<th>ID</th>
			<th>Nombre</th>
			<th>Sexo</th>
			<th>Edad</th>
			<th>Telefono</th>
			<th>Correo</th>
			<th>Detalles</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pacientes as $p)
			<tr>
				<td>{{$p->id}}</td>
				<td>{{$p->nombre. " " . $p->apellido_P . " " . $p->apellido_M}}</td>
				<td>{{$p->sexo}}</td>
				<td>{{date('Y-m-d') - $p->fecha_Nac}}</td>
				<td>{{$p->telefono}}</td>
				<td>{{$p->email}}</td>
				<td>{{$p->direccion. ", " . $p->municipio . ", " . $p->estado}}</td>
			</tr>
		@endforeach
	</tbody>
	</table>
</body>
</html>