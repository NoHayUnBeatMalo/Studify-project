<?php
require_once '../../modelo/modelo_conexion.php';
$con = new conexion();
$con->conectar();
if(isset($_POST['idusuario']) || isset($_POST['sexo'])){
    $idusuario = $_POST['idusuario'];
    $sexo = $_POST['sexo'];
    if($sexo == 'MASCULINO'){
        $new = 'FEMENINO';
        $con->consulta("UPDATE usuarios SET sexo='".$new."' WHERE idusuario='".$idusuario."';");
    }else{
        $new = 'MASCULINO';
        $con->consulta("UPDATE usuarios SET sexo='".$new."' WHERE idusuario='".$idusuario."';");
    }
}



?>