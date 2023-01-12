<?php
include '../../conexion.php';
$idusuario = $_POST['idusuario'];
//echo $idusuario;
$sql = "SELECT * FROM profesores WHERE id_usuario_profesor=$idusuario";
$consultaest = $pdo->prepare($sql);
$consultaest->execute();
$resultado = $consultaest->fetch(PDO::FETCH_ASSOC);
echo json_encode($resultado);
