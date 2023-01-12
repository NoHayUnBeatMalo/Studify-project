<?php 
include_once '../../conexion.php';
require '../../modelo/modelo_usuario.php';
$MU = new Modelo_Usuario();
$usuario = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
$libre = $MU->usuarioLibre($usuario);