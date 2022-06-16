<?php 

require '../../modelo/modelo_estudiante.php';

$ME = new Modelo_Estudiante();
$idestudiante = htmlspecialchars($_POST['idest'], ENT_QUOTES, 'UTF-8');
$poblacion = htmlspecialchars($_POST['poblacion'], ENT_QUOTES, 'UTF-8');
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');
$codpostal = htmlspecialchars($_POST['codpostal'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');


$consulta = $ME->modificarDatosEstudiante($idestudiante, $poblacion, $provincia, $codpostal, $tel);

echo $consulta;



?>