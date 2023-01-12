<?php


include_once '../../conexion.php';
$idusuario = $_GET['idusuario'];
$sql = "SELECT * FROM taskapp WHERE idusuario = '$idusuario'";
$selectList = $pdo->prepare($sql);

$selectList->execute();
$json = array();

$result = $selectList->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $resultado){
    $json[] = $resultado;
}

$jsonstring = json_encode($json);
echo $jsonstring;
/*
include_once '../../conexion.php';
$con = new conexion;
$con->conectar();
$idusuario = '14';
$query = "SELECT * FROM taskapp WHERE idusuario = '$idusuario'";
$result = $pdo->prepare($query);

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
*/
?>