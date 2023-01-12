<?php

require '../../modelo/modelo_profesor.php';

$MP = new Modelo_Profesor();
$idusu = htmlspecialchars($_POST['idusu'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$poblacion = htmlspecialchars($_POST['poblacion']);
$provincia = htmlspecialchars($_POST['provincia'], ENT_QUOTES, 'UTF-8');
$codpostal = htmlspecialchars($_POST['codpostal'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
$consulta = $MP->registrarProfesor($idusu, $nombre, $poblacion, $provincia, $codpostal, $tel);


