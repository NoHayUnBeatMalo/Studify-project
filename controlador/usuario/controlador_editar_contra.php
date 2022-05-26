<?php 

require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');
$contrabd = htmlspecialchars($_POST['contrabd'], ENT_QUOTES, 'UTF-8');
$contraActual = htmlspecialchars($_POST['contraActual'], ENT_QUOTES, 'UTF-8');
$contraNueva = htmlspecialchars($_POST['contraNueva'], ENT_QUOTES, 'UTF-8');

$consulta = $MU->modificarContrasena($idusuario, $contrabd, $contraActual, $contraNueva);

echo $consulta;
?>