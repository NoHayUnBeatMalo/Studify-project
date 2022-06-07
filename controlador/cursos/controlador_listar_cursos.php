<?php 


require '../../modelo/modelo_cursos.php';

$MC = new Modelo_Cursos();
$consulta = $MC->listarCursos();

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