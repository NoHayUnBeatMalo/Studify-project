<?php
    require_once '../../modelo/modelo_conexion.php';
    
    $idusuario = $_POST['idusuario'];
    function traerDatosUsuario($idusuario){
        $con = new conexion();
        $con->conectar();
        $sql = "SELECT * FROM usuarios WHERE idusuario='$idusuario'";
        $arreglo = array();
        $consulta = $con->consulta($sql);
        if(!$consulta){
            while($consulta_TDU = $con->extraer_registro()){
                $arreglo[] = $consulta_TDU;
            }
            return json_encode($arreglo);
            $con->cerrar();
        }
    }
    
    echo traerDatosUsuario($idusuario);






?>