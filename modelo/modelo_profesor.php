<?php
class Modelo_Profesor{
    function __construct(){
        include __DIR__.'/../conexion.php';
        
    }
    
    public function listarProfesores(){
        include __DIR__.'/../conexion.php';
        
        $sql = "SELECT * FROM profesores";
        $arreglo = array();
        $selectProfesores = $pdo->prepare($sql);
        $selectProfesores->execute();
        $resultado = $selectProfesores->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
        /*
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
    

    function registrarProfesor($idusu, $nombre, $poblacion, $provincia, $codpostal, $tel){
        include __DIR__.'/../conexion.php';
        
        $sql = "INSERT INTO profesores(id_usuario_profesor, nombre, poblacion, codigo_postal, provincia, telefono)
        VALUES ($idusu,$nombre, $poblacion, $codpostal, $provincia, $tel);";
        $insertProfesor = $pdo->prepare($sql);
        $resultado = $insertProfesor->execute();
        if($resultado){
            echo 1;
        }else{
            echo 2;
        }
        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            echo 1;
        }else{
            echo 2;
        }
        */
    }
    

    function modificarDatosProfesor($idprof, $nombre, $poblacion, $provincia, $cpostal, $tel){
        
        include __DIR__.'/../conexion.php';
        $sql = "UPDATE profesores SET 
        nombre = '$nombre', poblacion = '$poblacion', codigo_postal = '$cpostal', provincia = '$provincia', telefono = '$tel'
        WHERE id_profesor='$idprof'";
        $modificarprofesor = $pdo->prepare($sql);
        $modificarprofesor->execute();
        /*
        $consulta = $this->conexion->consulta($sql);
        if(!$consulta){
            return 1;
        }else{
            return 0;
        }
        */
    }
    
    function traerDatosProfesor($idprof){
        include __DIR__.'/../conexion.php';
        $sql = "SELECT * FROM profesores WHERE id_profesor='$idprof'";
        $arreglo = array();
        $selectDatosProfe = $pdo->prepare($sql);
        $selectDatosProfe->execute();

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