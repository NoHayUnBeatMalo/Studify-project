<?php 


require '../../modelo/modelo_profesor.php';

$MP = new Modelo_Profesor();
$consulta = $MP->listarProfesores();

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




?>