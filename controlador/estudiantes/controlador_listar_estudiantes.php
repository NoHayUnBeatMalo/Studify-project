<?php 


require '../../modelo/modelo_estudiante.php';

$ME = new Modelo_Estudiante();
$consulta = $ME->listarEstudiantes();

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