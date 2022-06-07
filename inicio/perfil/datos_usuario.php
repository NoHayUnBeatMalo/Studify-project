<?php
class Datos_Usuario{
    private $conexion;
    function __construct(){
        require_once '../../modelo/modelo_conexion.php';
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
    }
    function traerDatosUsuario($idusuario){
        $sql = "SELECT * FROM usuarios WHERE idusuario='$idusuario'";
        $arreglo = array();
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_TDU = $this->conexion->extraer_registro()){
                $arreglo[] = $consulta_TDU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
}





?>