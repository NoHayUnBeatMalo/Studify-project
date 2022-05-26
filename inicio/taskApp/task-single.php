<?php

include_once '../../modelo/modelo_conexion.php';
$con = new conexion;

$con->conectar(); 
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "SELECT * FROM taskapp WHERE idtarea = '$id'";
    $con->consulta($query);
    $json = array();
    while($fila = $con->extraer_registro()){
        $json[] = array(
            'name' => $fila['name'],
            'description' => $fila['description'],
            'id' => $fila['idtarea'],
            'estado' => $fila['estado']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}


?>