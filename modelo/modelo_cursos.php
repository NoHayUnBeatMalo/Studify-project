<?php

include __DIR__.'/../conexion.php';

class Modelo_Cursos
{
    function __construct()
    {
        include __DIR__.'/../conexion.php';
        /*
        
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        */
    }
    public function listarCursos()
    {
        include __DIR__.'/../conexion.php';
        
        $sql = "SELECT curso.cod_curso, curso.nombre_curso, curso.descripcion, curso.fechacurso, curso.precio_curso, curso.descuento, curso.fechapublicacion, curso.estado, profesores.nombre, profesores.id_profesor  FROM curso INNER JOIN profesores on curso.cod_profesor=profesores.id_profesor;";
        
        $selectCursos = $pdo->prepare($sql);
        $selectCursos->execute();
        $listaCursos = $selectCursos->fetchAll(PDO::FETCH_ASSOC);
        return $listaCursos;
        /*
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            while ($data = $this->conexion->extraer_registro()) {
                //array_map("utf8_encode", $data)
                $arreglo["data"][] = $data;
            }
            return $arreglo;
        } else {
            die("Error");
        }
        */
    }
    function registrarCurso($idprofesor, $nombrecurso, $descripcion, $precio, $descuento, $fechacurso){
        include __DIR__.'/../conexion.php';
        
        $newDate = date("Y/m/d", strtotime($fechacurso));
        $fechaActual = date('Y-m-d');
        $sql = "INSERT INTO curso( cod_profesor, nombre_curso, descripcion, precio_curso, descuento, fechapublicacion, estado, fechacurso)
            VALUES ('$idprofesor', '$nombrecurso', '$descripcion', '$precio', '$descuento', '$fechaActual', 'ACTIVO', STR_TO_DATE('$newDate', '%Y/%m/%d/'));";
        $insertCurso = $pdo->prepare($sql);
        $resultado = $insertCurso->execute();
        if($resultado){
            return 1;
        }else{
            return 0;
        }

        /*
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            echo 1;
        } else {
            echo 2;
        }
        */
    }
    
    function modificarDatosCurso($codcurso, $nombrecurso, $idprofesor, $fechacurso, $precio, $descripcion, $descuento)
    {
        include __DIR__.'/../conexion.php';
        

            $sql = "UPDATE curso SET 
        cod_profesor = '$idprofesor', nombre_curso = '$nombrecurso', descripcion = '$descripcion', precio_curso = '$precio', descuento= '$descuento', fechacurso= '$fechacurso'
        WHERE cod_curso='$codcurso'";
        $selectCurso = $pdo->prepare($sql);
        
        
        $resultado = $selectCurso->execute();
        if($resultado){
            return 1;
        }else{
            return 2;
        }
            /*
            $consulta = $this->conexion->consulta($sql);
            if (!$consulta) {
                echo '1';
            } else {
                echo  '2';
            }
            */
        
    }
}
