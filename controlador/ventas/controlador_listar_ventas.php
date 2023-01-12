<?php 


require '../../modelo/modelo_ventas.php';

$MV = new Modelo_Ventas();
$consulta = $MV->listarVentas();

if($consulta){
    
    echo json_encode($consulta);
    
}else{
    echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
}
