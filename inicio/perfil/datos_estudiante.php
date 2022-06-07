<?php
    require_once '../../modelo/modelo_conexion.php';
    
    $idusuario = $_POST['idusuario'];
    function traerDatosEstudiante($idusuario){
        $con = new conexion();
        $con->conectar();
        $sql = "SELECT * FROM estudiantes WHERE id_usuario_estudiante='$idusuario'";
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
    
    echo traerDatosEstudiante($idusuario);






?>