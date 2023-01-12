<?php 
include_once '../../conexion.php';
require '../../modelo/modelo_usuario.php';
//echo '<script>console.log("dentro del controlador")</script>';
$MU = new Modelo_Usuario();
$usuario = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
//echo '<script>console.log("'.$usuario.'")</script>';
$contra = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

$consulta = $MU->verificarUsuario($usuario, $contra);
if($consulta == ''){
    echo 0;
}else{
    echo $consulta;
}


?>