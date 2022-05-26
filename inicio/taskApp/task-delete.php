<?php

include_once '../../modelo/modelo_conexion.php';
$con = new conexion;

$con->conectar();
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "DELETE FROM taskapp WHERE idtarea = '$id'";
    $con->consulta($query);
    echo 'task deleted successfully';
}



?>