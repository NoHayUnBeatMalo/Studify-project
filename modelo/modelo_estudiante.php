<?php
class Modelo_Estudiante{
    private $conexion;
    function __construct(){
        include __DIR__.'/../conexion.php';
        
        /*
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
        */
    }
    
    public function listarEstudiantes(){
        include __DIR__.'/../conexion.php';
        
        $sql = "SELECT * FROM estudiantes";
        $arreglo = array();
        $selectest = $pdo->prepare($sql);
        $selectest->execute();
        $resultado = $selectest->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
        /*
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
        */
    }
    

    function registrarEstudiante($idusu, $poblacion, $cpostal, $provincia, $tel){
        include __DIR__.'/../conexion.php';
        
        $sql = "INSERT INTO estudiantes(id_usuario_estudiante, poblacion, codigo_postal, provincia, telefono,)
        VALUES ('$idusu', '$poblacion', '$cpostal', '$provincia', '$tel');";
        $insertEst = $pdo->prepare($sql);
        $insertEst->execute();
        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        */
    }
    

    function modificarDatosEstudiante($idestudiante, $poblacion, $provincia, $codpostal, $tel){
        include __DIR__.'/../conexion.php';
        
        $sql = "UPDATE estudiantes SET 
        poblacion = '$poblacion', codigo_postal = '$codpostal', provincia = '$provincia', telefono = '$tel'
        WHERE id_estudiante='$idestudiante'";
        $selectData = $pdo->prepare($sql);
        $resultado = $selectData->execute();
        if($resultado){
            return 1;
        }else{
            return 0;
        }
        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
        */
    }
    
    function traerDatosEstudiante($idest){
        include __DIR__.'/../conexion.php';
        $sql = "SELECT * FROM estudiantes WHERE id_profesor=$idest";
        $arreglo = array();
        $selectDataEst = $pdo->prepare($sql);
        $selectDataEst->execute();
        while($row = $selectDataEst->fetchAll(PDO::FETCH_ASSOC)){
            
            $arreglo[] = $row;
        }
        return $arreglo;
        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            while($consulta_TDU = $this->conexion->extraer_registro()){
                $arreglo[] = $consulta_TDU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
        */
    }
    

}