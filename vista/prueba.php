<?php 
    require_once ("../controlador/conexion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php
    $sql = $con -> prepare("SELECT * FROM historial, vacunadores, animales, vacunas WHERE historial.id_animal = animales.id_animal AND historial.id_vacuna = vacunas.id_vacuna AND historial.id_vacunador = vacunadores.id_vacunador ORDER BY historial.fecha ASC");
    $sql -> execute();
    
    date_default_timezone_set("America/Bogota");
    $fecha_hora = date('Y-m-d');
    
   
        
?>


<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../../imagenes/moto.png"/>

    <link rel="stylesheet" href="../css/tabla.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Vacunas</title>

</head>
<div class=" d-flex justify-content-center align-items-center ">
        <div class="main-container rounded-5 text-secondary" style="width: 85rem">

            <h2 class="text-center text-dark fs-1 fw-bold" style="margin-right: 25%;">Historial de Vacunas</h2>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <!-- <form action="../libreria/formatoexel/exel_usu.php">
                        <div ><button type="submit" class="btn btn-outline-dark m-1" >Descargar EXCEL</button></div> 
                    </form> -->
               
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-lg-6">
                    <form action="../index.php">
                        <button type="submit"  class="btn btn-dark m-1 shadow-sm">VOLVER</button>
                    </form>
                </div>    
                <div class="col-lg-6">
                    <form action="./agregar_hito.php">
                            <button type="submit" class="btn btn-dark m-1 shadow-sm">CREAR</button>
                    </form>
                </div>
            </div>
            <br><br><br>

            <table style="border:#000 solid 1px">
                <tr>
                    <thead>
                        <th class="text-center">ID</th>
                        <th class="text-center">Mascota</th>
                        <th class="text-center">Vacuna</th>
                        <th class="text-center">Vacunador</th>
                        <th class="text-center">Fecha de Vacunacion</th>
                        <th class="text-center">Fecha de Vencimiento</th>



                        <!-- Accion editar - eliminar -->
                        <th colspan= "2" style="text-align: center;"> Accion</th>
                    </thead>
                </tr>

                
                <tbody>
                    <?php
                        foreach($sql as $sq){


                            $comparar = strtotime( $sq['fecha']);
                            $actual= strtotime($fecha_hora);

                            $tresMesesDespues = strtotime('+3 months', $comparar);
                            // Calcula la diferencia en segundos entre las dos fechas
                            $diferenciaSegundos = strtotime( $sq['fecha']) - strtotime($fecha_hora);

                            // Convierte la diferencia en segundos a días
                            $restante = floor($diferenciaSegundos / (60 * 60 * 24));
                            
    
                            if ($tresMesesDespues > $actual) {
        
                                $fondo = 'rgba(175, 52, 52, 0.678)';
                                $campo = 'La vacuna está vencida,';
                                $fechas= 'renuevala';

                            }elseif($comparar === $actual){
                                
                                $fondo = '#DCD6D6';
                                $campo = 'Debe volver a aplicar la vacuna';
                                $fechas= 'Las vacuna vence hoy';
                            } 
                            
                            else {
                                // Hacer algo si la fecha no es mayor a 3 meses
                                $fondo = '#DCD6D6';
                                $campo = 'La vacuna está vigente, quedan:';
                                $fechas= $restante. "dias";
                            }

                    ?>
                    
                    
                        <tr>
                            <td class="text-dark text-center" style="background-color: #DCD6D6;"><?=$sq['id']?></td>
                            <td class="text-dark text-center" style="background-color: #DCD6D6;"><?=$sq['nombre']?></td>
                            <td class="text-dark text-center" style="background-color: #DCD6D6;"><?=$sq['vacuna']?></td>
                            <td class="text-dark text-center" style="background-color: #DCD6D6;"><?=$sq['vacunador']?></td>
                            <td class="text-dark text-center" style="background-color: #DCD6D6;"><?=$sq['fecha']?></td>

                            <td class="text-dark text-center" style="background-color: <?php echo $fondo;?>;"><?=$campo?><?=$fechas?></td>



                         

                            
                            <td style="background-color: #DCD6D6; border:#000 solid 2px;">
                                <form action= "./edit_hito.php" method="get">
                                    <input type="hidden" name="update" value= "<?=$sq['id']?>">
                                    <button type= "submit" class="btn btn-dark text-white w-70 mt-4 fw-semibold shadow-sm">Revacunar</button>
                                </form>

                            </td>
                            <td style="background-color: #DCD6D6; border:#000 solid 2px;">
                                <form action= "./eliminar_histo.php" method="get">
                                    <input type="hidden" name="eliminar" value= "<?=$sq['id']?>">
                                    <button type="submit" class="btn btn-dark text-white w-70 mt-4 fw-semibold shadow-sm" onclick="return confirm ('¿Desea eliminar este ID?');">Eliminar</button>
                                </form>
                            </td>


                        </tr>   
                        
                        

                    
                </tbody>
                <?php
                }

                ?>
            </table>    
            <br>

        </div>      
        
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<body>
</html>



