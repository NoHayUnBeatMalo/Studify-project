<?php 
session_start();
$idusuario = $_POST['idusuario'];
$user = $_POST['user'];
$rol = $_POST['rol'];
$tipo = $_POST['tipo'];

$_SESSION['S_IDUSUARIO']=$idusuario;
$_SESSION['S_USER']=$user;
$_SESSION['S_ROL']=$rol;
$_SESSION['S_IDTIPO'] = $tipo;

    ?>