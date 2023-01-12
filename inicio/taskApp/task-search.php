<?php

include_once '../../conexion.php';

$idusuario = $_POST['idusuario'];
$search = $_POST['search'];



if(!empty($search)){
    $sql = "SELECT idtarea, name, description, estado FROM taskapp WHERE name LIKE '%$search%' AND idusuario = $idusuario";
    $selectSearch = $pdo->prepare($sql);
    $selectSearch->execute();
    $json = array();
    $resultado = $selectSearch->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $result){
        $json[] = $result;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
    
}


?>