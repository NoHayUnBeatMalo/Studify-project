<?php

include_once '../../modelo/modelo_conexion.php';
$con = new conexion;

$con->conectar();

$idtarea = $_POST['idtarea'];
$arraylista = $_POST['array-lista'];
foreach($arraylista as $indice => $lista){
    
}
$query = "UPDATE taskapp SET name = '$name', description = '$description', estado= '$estado' WHERE idtarea = '$id'";
$result = $con->consulta($query);
?>