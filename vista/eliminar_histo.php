<?php

//coneccion
session_start();
require ("../controlador/conexion.php");
$db = new Database();
$conectar = $db -> conectar();
$delete= $_GET['eliminar'];


    

 
        // se trae la variable recibida por $ GET desede productos.php
    $sql =$conectar -> prepare("DELETE FROM historial WHERE id='".$_GET['eliminar']."'");
    $sql-> execute();
    echo '<script>alert ("Se elimino el ID con Exito");</script>';
    echo '<script>window.location="historial_vacs.php"</script>';
    exit();


?>
