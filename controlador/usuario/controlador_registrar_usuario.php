<?php 

include_once '../../conexion.php';
require '../../modelo/modelo_usuario.php';
include_once '../../modelo/modelo_estudiante.php';
include_once '../../modelo/modelo_profesor.php';

$MU = new Modelo_Usuario();

$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
$apellidos = htmlspecialchars($_POST['ape'], ENT_QUOTES, 'UTF-8');
$fnac = htmlspecialchars($_POST['fnac'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$contrasena = htmlspecialchars($_POST['contrasena'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
$sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
$tipousu = htmlspecialchars($_POST['tipousu'], ENT_QUOTES, 'UTF-8');

$registrar = $MU->registrarUsuario($usuario, $nombre, $apellidos, $fnac, $contrasena, $email,  $rol, $sexo, $tipousu);
if($registrar){
    return 1;
}else{
    return 0;
}
