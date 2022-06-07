<?php 

require '../../modelo/modelo_cursos.php';

$MC = new Modelo_Cursos();
$codcurso = htmlspecialchars($_POST['codcurso'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$horas = htmlspecialchars($_POST['horas'], ENT_QUOTES, 'UTF-8');
$precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
$nombreprofesor = htmlspecialchars($_POST['nombreprofesor'], ENT_QUOTES, 'UTF-8');
$participantes = htmlspecialchars($_POST['participantes'], ENT_QUOTES, 'UTF-8');


$consulta = $MC->modificarDatosCurso($codcurso, $nombre, $nombreprofesor, $horas, $precio, $participantes);

echo $consulta;



?>