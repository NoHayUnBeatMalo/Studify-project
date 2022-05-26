<?php 
$idusuario = $_POST['idusuario'];
$user = $_POST['user'];
$rol = $_POST['rol'];
session_start();
$_SESSION['S_IDUSUARIO']=$idusuario;
$_SESSION['S_USER']=$user;
$_SESSION['S_ROL']=$rol;






?>