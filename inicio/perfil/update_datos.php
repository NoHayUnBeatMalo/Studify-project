<?php
require_once '../../modelo/modelo_conexion.php';

if(isset($_POST['idusuario']) || isset($_POST['nombreusuario']) || isset($_POST['nombre']) || isset($_POST['apellidos']) || isset($_POST['correo']) || isset($_POST['telefono']) || isset($_POST['provincia']) || isset($_POST['codigopostal'])){
    $idusuario = $_POST['idusuario'];
    $nusu = $_POST['nombreusuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $poblacion = $_POST['poblacion'];
    $codigopostal = $_POST['codigopostal'];
    $con = new conexion();
    $con->conectar();
    $sql = "UPDATE usuarios SET nombre_usuario = '".$nusu."', nombre ='".$nombre."', apellidos ='".$apellidos."' , correo ='".$correo."' WHERE idusuario = '".$idusuario."'; ";
    $consulta = $con->consulta($sql);
    if(!$consulta){
        return 1;
    }else{
        return 2;
    }
}else{
    return 0;
}



?>