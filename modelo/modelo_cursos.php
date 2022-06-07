<?php
class Modelo_Cursos
{
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $con = $this->conexion->conectar();
    }
    public function listarCursos()
    {
        $con = mysqli_connect('localhost', 'root', '', 'tfg');
        $sql = "SELECT curso.cod_curso , profesores.nombre, curso.nombre_curso, curso.horas_curso, curso.precio_curso, curso.fechapublicacion, curso.participantes, curso.estado, curso.cod_profesor  FROM curso INNER JOIN profesores ON curso.cod_profesor = profesores.id_profesor";
        $arreglo = array();
        $consulta = mysqli_query($con, $sql);
        if ($consulta) {
            while ($data = mysqli_fetch_assoc($consulta)) {
                //array_map("utf8_encode", $data)
                $arreglo["data"][] = $data;
            }
            return $arreglo;
        } else {
            die("Error");
        }
        mysqli_free_result($consulta);
        mysqli_close($con);
    }
    function registrarCurso($nombrecurso, $nombreprofesor, $horas, $precio)
    {
        //$sqlSelect = "SELECT idusuario FROM usuarios WHERE usuarios.nombre_usuario = '$usuario'";
        //$consultaSelect = $this->conexion->consulta($sqlSelect);
        //if (!$consultaSelect) {

        $selectidprof = "SELECT id_profesor FROM profesores WHERE nombre = '$nombreprofesor';";
        $consultaidprof = $this->conexion->consulta($selectidprof);
        if (!$consultaidprof) {
            while ($consultaCodProf = $this->conexion->extraer_registro()) {
                $codprof = $consultaCodProf;
            }
            $fechaActual = date('Y-m-d');
            $sql = "INSERT INTO curso(nombre_curso, cod_profesor, horas_curso, precio_curso, fechapublicacion, participantes, estado)
            VALUES ('$nombrecurso', '$codprof', '$horas', '$precio', '$fechaActual', '0', 'ACTIVO');";
            $consulta = $this->conexion->consulta($sql);
            if (!$consulta) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo '0';
        }

        //} else {
        //echo '0';
        //}
    }
    function modificarDatosCurso($codcurso, $nombrecurso, $nombreprofesor, $horas, $precio, $participantes)
    {
        $selectidprof = "SELECT id_profesor FROM profesores WHERE nombre = '$nombreprofesor';";
        $consultaidprof = $this->conexion->consulta($selectidprof);
        if (!$consultaidprof) {
            while ($consultaCodProf = $this->conexion->extraer_registro()) {
                $codprof = $consultaCodProf;
            }

            $sql = "UPDATE curso SET 
        cod_profesor = '$codprof', nombre_curso = '$nombrecurso', horas_curso = '$horas', precio_curso = '$precio', participantes= '$participantes'
        WHERE cod_curso='$codcurso'";
            $consulta = $this->conexion->consulta($sql);
            if (!$consulta) {
                echo '1';
            } else {
                echo  '2';
            }
        } else {
            echo '0';
        }
    }
}
