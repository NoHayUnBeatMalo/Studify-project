<?php
//token para cifrar informacion
define("KEY_TOKEN", "JDR.stt-895*");
define("MONEDA", "€");

session_start();
$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = $_SESSION['carrito']['productos'];
}
?>