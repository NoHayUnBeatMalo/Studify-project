<?php
include_once '../../modelo/modelo_conexion.php';
$con = new conexion;
$con->conectar();

if(isset($_POST['nuevoitem']) && isset($_POST['idusuario']) && isset($_POST['idpuntoclave'])){
    $idpuntoclave = $_POST['idpuntoclave'];
    //obtenemos el array de puntos 
    $queryselectarray = "SELECT arraypc FROM puntosclave WHERE idpclave= '$idpuntoclave';";
    //consulta
    $resselect = $con->consulta($queryselectarray);
    if(!$resselect){
        //extraer registro
        while($fila = $con->extraer_registro()){
            $lista = $fila['arraypc'];
        }

        $namepc = $_POST['nuevoitem'];
        $idusuario = $_POST['idusuario'];
        $addtolist = '';
        //si la lista recibida es distinta de lo que se quiere introducir 
        if($lista != $namepc){
            $addtolist = $lista . ', ' . $namepc;
            //update array
            $query = "UPDATE puntosclave SET arraypc = '$addtolist' WHERE idpclave = '$idpuntoclave'";
            $result = $con->consulta($query);
            if(!$result){
                echo 1;
            }
        }
        
    }else{
        echo 0;
    }

}


?>