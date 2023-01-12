<?php
include_once '../../conexion.php';


if(isset($_POST['nuevoitem']) && isset($_POST['idusuario']) && isset($_POST['idtarea']) && isset($_POST['idpuntoclave'])){
    $idpuntoclave = $_POST['idpuntoclave'];
    $idtarea = $_POST['idtarea'];
    //obtenemos el array de puntos 
    $queryselectarray = "SELECT puntoclave FROM puntosclave WHERE idpclave= '$idpuntoclave' AND idtarea='$idtarea';";

    //consulta
    $resselect = $pdo->prepare($queryselectarray);
    $resselect->execute();
    $resultadoselect = $resselect->fetchAll(PDO::FETCH_ASSOC);

    
        //extraer registro
        
            $lista = $resultadoselect['puntoclave'];
        

        $namepc = $_POST['nuevoitem'];
        $idusuario = $_POST['idusuario'];
        $addtolist = '';
        //si la lista recibida es distinta de lo que se quiere introducir 
        if($lista != $namepc){
            $addtolist = $lista . ', ' . $namepc;
            //update array
            $query = "INSERT INTO puntosclave (arraypc, idtarea, idusuario) VALUES ('$addtolist', '$idtarea', '$idusuario')";
            $updatePC = $pdo->prepare($query);
            $updatePC->execute();
            if($updatePC){
                echo 1;
            }
        }
        
    

}
