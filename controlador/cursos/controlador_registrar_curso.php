<?php 

require '../../modelo/modelo_cursos.php';

$MC = new Modelo_Cursos();
$nombrecurso = htmlspecialchars($_POST['nombrecurso'], ENT_QUOTES, 'UTF-8');
$nombreprofesor  = htmlspecialchars($_POST['nombreprofesor'], ENT_QUOTES, 'UTF-8');
$horas = htmlspecialchars($_POST['horas'], ENT_QUOTES, 'UTF-8');
$precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');



$consulta = $MC->registrarCurso($nombrecurso, $nombreprofesor, $horas, $precio);

echo $consulta;



?>