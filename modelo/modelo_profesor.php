<?php
class Modelo_Profesor{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
    }
    
    public function listarProfesores(){
        $con = mysqli_connect('localhost', 'root', '', 'tfg');
        $sql = "SELECT * FROM profesores";
        $arreglo = array();
        $consulta = mysqli_query($con, $sql);
        if($consulta){
            while($data = mysqli_fetch_assoc($consulta)){
                    //array_map("utf8_encode", $data)
                    $arreglo["data"][]= $data;
            }
            return $arreglo["data"];
        }else{
            die("Error");
        }
        mysqli_free_result($consulta);
        mysqli_close($con);
    }
    

    function registrarProfesor($idusu, $nombre, $poblacion, $provincia, $codpostal, $tel){
        
        $sql = "INSERT INTO profesores(id_usuario_profesor, nombre, poblacion, codigo_postal, provincia, telefono)
        VALUES ('$idusu','$nombre', '$poblacion', '$codpostal', '$provincia', '$tel');";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        
    }
    

    function modificarDatosProfesor($idprof, $nombre, $poblacion, $provincia, $cpostal, $tel){
        $sql = "UPDATE profesores SET 
        nombre = '$nombre', poblacion = '$poblacion', codigo_postal = '$cpostal', provincia = '$provincia', telefono = '$tel'
        WHERE id_profesor='$idprof'";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
    }
    
    function traerDatosProfesor($idprof){
        $sql = "SELECT * FROM profesores WHERE id_profesor='$idprof'";
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