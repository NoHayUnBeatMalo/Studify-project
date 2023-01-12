<?php
include '../../conexion.php';
$idusuario = $_POST['idusuario'];
//echo $idusuario;
$sql = "SELECT * FROM estudiantes WHERE id_usuario_estudiante=$idusuario";
$consultaest = $pdo->prepare($sql);
$consultaest->execute();
$resultado = $consultaest->fetch(PDO::FETCH_ASSOC);
echo json_encode($resultado);



?>