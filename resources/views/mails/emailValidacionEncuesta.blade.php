@if ($motivo == 'Rechazo')

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evaluación de Encuesta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
<h1>Encuesta Evaluada</h1>
	<p class="text-justify">Estimado/a usuario/a, la encuesta ha sido evaluada</p>.
	<p>El equipo de la Unidad de  Desarrollo Local Inclusivo de SENADIS encontró observaciones de los datos enviados por usted lo cual deberá revisar nuevamente a través del siguiente enlace:<a href={{"http://".$_SERVER['HTTP_HOST']."/login"}}>{{"http://".$_SERVER['HTTP_HOST']."/login"}}</a> donde encontrará las observaciones de nuestra evaluacion.Si desea modificar los datos puede solicitarlo a través de la opción de mensajería.</p>
    
    <p><b>Motivo de Rechazo por  el Equipo de la Unidad de Desarrollo Local Inclusivo de SENADIS:</b>
       {{$motivo_Rechazo."\n"}}
     </p>

	<p><b>A continuación se muestran las Preguntas en donde el medio de verificación no corresponde con la pregunta:</b></p>
	   <ul>  
	    @foreach((array)$lista_preg_rechazadas as $row)
	      <li>{{ $row }}</li>
	    @endforeach
	 </ul>
	   
	<p> Atentamente,<br><br>
	   					Equipo Desarrollo Local Inclusivo <br>
					    Departamento de Políticas y Coordinación Intersectorial<br>
						Servicio Nacional de la Discapacidad | Gobierno de Chile<br>
	           <b>Senadis {{ date('Y') }}</b>
	</p>
</body>
</html>

@else

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evaluacion de Encuesta</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
	<h1>Encuesta Evaluada</h1>
		<p>Estimado/a usuario/a, la encuesta ha sido evaluada satisfactoriamente.</p>
		<p>El equipo de la Unidad de  Desarrollo Local Inclusivo de SENADIS reviso los datos
		  proporcionados por usted y la evaluación de la encuesta fue Aceptada, podrá revisar su encuesta a través del siguiente enlace:<a href={{"http://".$_SERVER['HTTP_HOST']."/login"}}>{{"http://".$_SERVER['HTTP_HOST']."/login"}}</a>
		</p>

	<p> Atentamente,<br><br>
	   		Equipo Desarrollo Local Inclusivo<br>
			Departamento de Políticas y Coordinación Intersectorial<br>
			Servicio Nacional de la Discapacidad | Gobierno de Chile<br>
	       <b>Senadis {{ date('Y') }}</b>
	</p>
 </body>
</html>

@endif