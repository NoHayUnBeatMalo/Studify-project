<?php 


require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$consulta = $MU->listarTipoUsu();
echo json_encode($consulta);






?>