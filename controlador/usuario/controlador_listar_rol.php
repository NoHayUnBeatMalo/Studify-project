<?php 


require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$consulta = $MU->listarRol();
echo json_encode($consulta);






?>