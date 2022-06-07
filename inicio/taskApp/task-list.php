<?php

include_once '../../modelo/modelo_conexion.php';
$con = new conexion;
$con->conectar();
$idusuario = '14';
$query = "SELECT * FROM taskapp WHERE idusuario = '$idusuario'";
$result = $con->consulta($query);

$json = array();
while($fila = $con->extraer_registro()){
    $json[] = array(
        'name' => $fila['name'],
        'description' => $fila['description'],
        'id' => $fila['idtarea'],
        'estado' => $fila['estado'],
        'idpuntosClave' => $fila['puntosclave']
    );
}
$jsonstring = json_encode($json);
echo $jsonstring;
?>