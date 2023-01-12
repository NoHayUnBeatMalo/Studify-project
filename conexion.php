<?php 


$servidor = 'mysql:dbname=tfg;host=localhost';
$usuario = "root";
$password = "";
try {
    $pdo = new PDO('mysql:dbname=tfg;host=localhost', $usuario,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conectando";
} catch (PDOException $ex) {
    echo "Error al conectar: " . $ex->getMessage();
}


?>