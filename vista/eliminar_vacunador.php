<?php

//coneccion
session_start();
require ("../controlador/conexion.php");
$db = new Database();
$conectar = $db -> conectar();
$delete= $_GET['eliminar'];


    

 
        // se trae la variable recibida por $ GET desede productos.php
    $sql =$conectar -> prepare("DELETE FROM vacunadores WHERE id_vacunador='".$_GET['eliminar']."'");
    $sql-> execute();
    echo '<script>alert ("Se elimino el usuario con Exito");</script>';
    echo '<script>window.location="vacunadores.php"</script>';
    exit();


?>
