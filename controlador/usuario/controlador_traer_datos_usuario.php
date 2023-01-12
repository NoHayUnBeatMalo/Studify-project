<?php 
include_once '../../conexion.php';
require '../../modelo/modelo_usuario.php';
//echo '<script>console.log("dentro del controlador traerdatosusu")</script>';
$MU = new Modelo_Usuario();

$user = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
//echo '<script>console.log('.$user.')</script>';

$consulta = $MU->traerDatosUsuario($user);
echo $consulta;
//echo memory_get_usage();



?>