<?php
include_once '../../conexion.php';

if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['idusuario'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $idusuario = $_POST['idusuario'];
    $sql = "INSERT INTO taskapp(name, description, estado, idusuario) VALUES ('$name', '$description', 'SIN EMPEZAR', '$idusuario')";
    $insertTask = $pdo->prepare($sql);
    $insertTask->execute();

}


?>