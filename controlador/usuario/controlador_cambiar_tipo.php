<?php

require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');
$tipoid = htmlspecialchars($_POST['tipoid'], ENT_QUOTES, 'UTF-8');

$cambiarTipo = $MU->cambiarTipoId($idusuario, $tipoid);

