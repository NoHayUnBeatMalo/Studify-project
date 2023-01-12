<?php

include_once '../../conexion.php';


if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM taskapp WHERE idtarea = '$id'";
    $deleteTask = $pdo->prepare($sql);
    $deleteTask->execute();
    
    echo 'task deleted successfully';
}



?>