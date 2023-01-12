<?php
include_once __DIR__.'/../conexion.php';
class Modelo_Ventas{
    function __construct()
    {
        include_once __DIR__.'/../conexion.php';
    }
    function listarVentas()
    {
        
        include __DIR__.'/../conexion.php';
        $sql = "SELECT * FROM ventas";
        $selectventas = $pdo->prepare($sql);
        $selectventas->execute();

        $listaventas = $selectventas->fetchAll(PDO::FETCH_ASSOC);
        return $listaventas;
        
    }
    function listarVentasDetalle(){
        include __DIR__.'/../conexion.php';
        $sql = "SELECT * FROM ventas_detalle";
        $selectventasdetalle = $pdo->prepare($sql);
        $selectventasdetalle->execute();

        $listaventasdetalle = $selectventasdetalle->fetchAll(PDO::FETCH_ASSOC);
        return $listaventasdetalle;
    }
}
