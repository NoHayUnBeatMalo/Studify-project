<?php

include_once '../../conexion.php';



if(isset($_POST['id']) && isset($_POST['idusuario'])){
    $id = $_POST['id'];
    $idusuario = $_POST['idusuario'];
    $sql = "SELECT idtarea, name, description, estado FROM taskapp WHERE idtarea = $id AND idusuario= $idusuario;";
    $json = array();
    $selectTask = $pdo->prepare($sql);
    $selectTask->execute();
    $resultado = $selectTask->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $result){
        $json[] = $result;
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


?>