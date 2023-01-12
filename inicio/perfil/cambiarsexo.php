<?php
require_once '../../conexion.php';
if(isset($_POST['idusuario']) || isset($_POST['sexo'])){
    $idusuario = $_POST['idusuario'];
    $sexo = $_POST['sexo'];
    if($sexo == 'MASCULINO'){
        $new = 'FEMENINO';
        $cambiarsexo = $pdo->prepare("UPDATE usuarios SET sexo='".$new."' WHERE idusuario='".$idusuario."';");
        $cambiarsexo->execute();
        
    }else{
        $new = 'MASCULINO';
        $cambiarsexo = $pdo->prepare("UPDATE usuarios SET sexo='".$new."' WHERE idusuario='".$idusuario."';");
        $cambiarsexo->execute();
        
    }
}



?>