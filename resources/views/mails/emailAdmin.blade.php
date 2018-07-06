<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Encuesta Enviada: {{ $nombre_institucion }}</title>
</head>
<body>
	<h2>Datos de envío</h2>
	<p>Fecha de envío: {{ $fecha_envio }}</p>
	<p>Municipalidad: {{ $nombre_institucion }}</p>
	<p>Región: {{ Auth::user()->nombreRegionInstitucion() }}</p>
	<p>Usuario: {{ $name_user }}</p>
</body>
</html>