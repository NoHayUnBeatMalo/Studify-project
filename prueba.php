<?php 
require_once 'modelo/modelo_conexion.php';

    $conexion = new conexion;
    $conexion->conectar();
    $pass = $conexion->encrypt_decrypt('encrypt', '123');
    
    echo $pass;

?>