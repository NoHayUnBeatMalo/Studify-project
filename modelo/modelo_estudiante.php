<?php
class Modelo_Estudiante{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
    }
    
    public function listarEstudiantes(){
        $con = mysqli_connect('localhost', 'root', '', 'tfg');
        $sql = "SELECT * FROM estudiantes";
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
    

    function registrarEstudiante($idusu, $poblacion, $cpostal, $provincia, $tel){
        
        $sql = "INSERT INTO estudiantes(id_usuario_estudiante, poblacion, codigo_postal, provincia, telefono,)
        VALUES ('$idusu', '$poblacion', '$cpostal', '$provincia', '$tel');";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        
    }
    

    function modificarDatosEstudiante($idestudiante, $poblacion, $provincia, $codpostal, $tel){
        $sql = "UPDATE estudiantes SET 
        poblacion = '$poblacion', codigo_postal = '$codpostal', provincia = '$provincia', telefono = '$tel'
        WHERE id_estudiante='$idestudiante'";
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
    }
    
    function traerDatosEstudiante($idest){
        $sql = "SELECT * FROM estudiantes WHERE id_profesor='$idest'";
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