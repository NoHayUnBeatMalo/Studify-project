<?php 

require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');
$estatus = $_POST['estatus'];
$consulta = $MU->modificarEstatusUsuario($idusuario, $estatus);

echo $consulta;



?>