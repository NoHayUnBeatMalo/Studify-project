<?php 

require '../../modelo/modelo_usuario.php';
require '../../modelo/modelo_estudiante.php';
require '../../modelo/modelo_profesor.php';

$MU = new Modelo_Usuario();
$ME = new Modelo_Estudiante();
$MP = new Modelo_Profesor();
$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
$apellidos = htmlspecialchars($_POST['ape'], ENT_QUOTES, 'UTF-8');
$fnac = htmlspecialchars($_POST['fnac'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$contrasena = htmlspecialchars($_POST['contrasena'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
$sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
$tipousu = htmlspecialchars($_POST['tipousu'], ENT_QUOTES, 'UTF-8');
//admin
if($rol == 1){
    $tipousu = NULL;
    $consulta = $MU->registrarUsuario($usuario, $nombre, $apellidos, $fnac, $contrasena, $email,  $rol, $sexo, $tipousu);
    
}else{
    $consulta = $MU->registrarUsuario($usuario, $nombre, $apellidos, $fnac, $contrasena, $email,  $rol, $sexo, $tipousu);
    
}
echo $consulta;




?>