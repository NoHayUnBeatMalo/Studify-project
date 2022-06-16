<?php
include_once '../../modelo/modelo_conexion.php';
$con = new conexion;

$con->conectar();
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['idusuario'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $idusuario = $_POST['idusuario'];
    $query = "INSERT INTO taskapp(name, description, estado, puntosclave, idusuario) VALUES ('$name', '$description', 'SIN EMPEZAR', '', '$idusuario')";
    $result = $con->consulta($query);
    

}


?>