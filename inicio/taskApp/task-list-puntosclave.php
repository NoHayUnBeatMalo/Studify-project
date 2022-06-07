<?php

include_once '../../modelo/modelo_conexion.php';
$con = new conexion;
$con->conectar();
$idpuntoclave = $_GET['idpuntoclave'];
$query = "SELECT `arraypc` FROM `puntosclave` WHERE `idpclave` = '$idpuntoclave';";
$result = $con->consulta($query);

$lista = '';
$arraylista = array();
while($fila = $con->extraer_registro()){
    if(isset($fila['arraypc'])){
        $lista = $fila['arraypc'];
    }
}
if($lista != ''){
    $arraylista = str_replace(',', ' ', $lista);
    $alis = explode('  ', $arraylista); 
    echo json_encode($alis);
}else{
    echo 'SIN PUNTOS CLAVE';
}



?>