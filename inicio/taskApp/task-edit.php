<?php

include_once '../../conexion.php';

/*
$con = new conexion;

$con->conectar();
*/
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$estado = $_POST['estado'];
$query = "UPDATE taskapp SET name = '$name', description = '$description', estado= '$estado' WHERE idtarea = '$id'";
$result = $pdo->prepare($query);
$result->execute();

?>