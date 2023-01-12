<?php

require '../../modelo/modelo_cursos.php';

$MC = new Modelo_Cursos();

    
    
    $nombrecurso = htmlspecialchars($_POST['nombrecurso'], ENT_QUOTES, 'UTF-8');
    $idprofesor = htmlspecialchars($_POST['idprofesor'], ENT_QUOTES, 'UTF-8');
    $fechacurso = htmlspecialchars($_POST['fechacurso']);
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
    $descuento = htmlspecialchars($_POST['descuento'], ENT_QUOTES, 'UTF-8');
    $registrarCurso = $MC->registrarCurso($idprofesor, $nombrecurso, $descripcion, $precio, $descuento, $fechacurso);
    if($registrarCurso){
        return $registrarCurso;
    }

