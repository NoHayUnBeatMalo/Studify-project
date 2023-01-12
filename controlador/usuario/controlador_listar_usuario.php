<?php 


require '../../modelo/modelo_usuario.php';

$MU = new Modelo_Usuario();
$consulta = $MU->listarUsuario();
//echo '<script>alert("esta es la consulta: '.json_encode($consulta).'");</script>';

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