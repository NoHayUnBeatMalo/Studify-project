<?php
class Modelo_Cursos
{
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }
    public function listarCursos()
    {
        
        $sql = "SELECT curso.cod_curso, curso.nombre_curso, curso.descripcion, curso.fechacurso, curso.precio_curso, curso.descuento, curso.fechapublicacion, curso.estado, profesores.nombre, profesores.id_profesor  FROM curso INNER JOIN profesores on curso.cod_profesor=profesores.id_profesor;";
        $arreglo = array();
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
    }
    function registrarCurso($idprofesor, $nombrecurso, $descripcion, $precio, $descuento, $fechacurso){
        $newDate = date("Y/m/d", strtotime($fechacurso));
        $fechaActual = date('Y-m-d');
        $sql = "INSERT INTO curso( cod_profesor, nombre_curso, descripcion, precio_curso, descuento, fechapublicacion, estado, fechacurso)
            VALUES ('$idprofesor', '$nombrecurso', '$descripcion', '$precio', '$descuento', '$fechaActual', 'ACTIVO', STR_TO_DATE('$newDate', '%Y/%m/%d/'));";
        $consulta = $this->conexion->consulta($sql);
        if (!$consulta) {
            echo 1;
        } else {
            echo 2;
        }
    }
    
    function modificarDatosCurso($codcurso, $nombrecurso, $idprofesor, $fechacurso, $precio, $descripcion, $descuento)
    {
        

            $sql = "UPDATE curso SET 
        cod_profesor = '$idprofesor', nombre_curso = '$nombrecurso', descripcion = '$descripcion', precio_curso = '$precio', descuento= '$descuento', fechacurso= '$fechacurso'
        WHERE cod_curso='$codcurso'";
            $consulta = $this->conexion->consulta($sql);
            if (!$consulta) {
                echo '1';
            } else {
                echo  '2';
            }
        
    }
}
