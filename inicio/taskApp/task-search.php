<?php

include_once '../../modelo/modelo_conexion.php';+
$con = new conexion;

$con->conectar();
$idusuario = $_POST['idusuario'];
$search = $_POST['search'];
if(!empty($search)){
    $query = "SELECT * FROM taskapp WHERE name LIKE '%$search%' AND idusuario = '$idusuario'";
    $result = $con->consulta($query);
    $json = array();
    while($fila = $con->extraer_registro()){
        
        $json[] = array(
            'name' => $fila['name'],
            'description' => $fila['description'],
            'id' => $fila['idtarea'],
            'estado' => $fila['estado']
        );
        
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


?>