<?php 

require '../../modelo/modelo_profesor.php';

$MP = new Modelo_Profesor();
$idprofesor = htmlspecialchars($_POST['idprof'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$poblacion = htmlspecialchars($_POST['poblacion'], ENT_QUOTES, 'UTF-8');
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');
$codpostal = htmlspecialchars($_POST['codpostal'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');


$consulta = $MP->modificarDatosProfesor($idprofesor, $nombre, $poblacion, $provincia, $codpostal, $tel);
if(!$consulta) {
   return 'Algo salió mal';
}else{
   return $consulta;
}
