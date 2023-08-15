<?php 
    require_once ("../controlador/conexion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php
 $most = $con -> prepare("SELECT MAX(id) + 1 AS id FROM historial"); 
 $most-> execute();
 $trar = $most->fetch(PDO::FETCH_ASSOC);
        
$nadores = $con -> prepare("SELECT *FROM vacunadores"); 
$nadores-> execute();
$nador = $nadores->fetch();

$animales = $con -> prepare("SELECT *FROM animales"); 
$animales-> execute();
$nimal = $animales->fetch();

$select = $con -> prepare("SELECT *FROM vacunas"); 
$select-> execute();
$row = $select->fetch();

date_default_timezone_set("America/Bogota");
$fecha_hora= date('Y-m-d');

    if((isset($_GET["agre"]))&&($_GET["agre"]=="tipu"))
    {
        $id= $_GET['id'];
        $date= $_GET['fecha'];
        $vacunadores= $_GET['nador'];
        $vacuna= $_GET['cuna'];
        $animal= $_GET['animal'];

        


        // validar si la moto ya existe 

        $num_mot= $con->prepare("SELECT * FROM historial WHERE id_animal='$animal' AND id_vacuna = '$vacuna'");
        $num_mot-> execute();
        $motor_num= $num_mot-> fetch();
    
        if ($date=="" || $vacunadores=="" || $vacuna=="" || $animal=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>window.location="agregar_hito.php"</script>';
        }
        elseif ($motor_num){
            echo '<script>alert("La vacunación ya existe //CAMBIELO//");</script>';
            echo '<script>windows.location="agregar_hito.php"</script>';
        }else
        {
            $registro = $con->prepare("INSERT INTO `historial` (`fecha`, `id_vacunador`, `id_vacuna`, `id_animal`) VALUES (?, ?, ?, ?)");
    
            $registro->execute([$date, $vacunadores, $vacuna, $animal]);

            echo '<script>alert ("REGISTRO EXITOSO");</script>';
            echo '<script>window.location="historial_vacs.php"</script>';
        
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../../../imagenes/moto.png"/>
    <title>CREAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
</head>
<body class="bg-dark d-flex justify-content-center align-items-center vh-100" style="background-color: #C4C4C4;">

    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 45rem; margin-bottom: 15rem; margin-top: 15rem;">


        

            <form method="get" name="formreg" autocomplete="off" style="height: 30rem;">

            <div style="height: 5rem; margin-bottom: 2rem;"><h2 class="text-center text-dark fs-1 fw-bold"> VACUNAR</h2> </div>
                
                <label for="">ID</label>
                <input type="text" class="form-control bg-light" name="id" value="<?php echo $trar['id']; ?>" readonly><br>

                <label for="">Fecha</label>
                <input type="date" class="form-control bg-light" name="fecha" value="<?php echo $fecha_hora; ?>">



                
            <div class="container">
                <div class="row gap-2">    

                    <select class="form-control bg-light col-lg-4" name="nador" style="margin-top: 2rem; margin-bottom: 1rem; width: 12rem; height: 3rem;" required>
                                
                                <option value="1" class="text-center" selected disabled="">Vacunador</option>
                                
                                <?php
                                    do {

                                ?>
                                <option value="<?php echo($nador ['id_vacunador'])?>"><?php echo($nador ['vacunador'])?></option>

                                <?php
                                    }while($nador = $nadores->fetch());
                                ?>

                        </select>

                            
                        <select class="form-control bg-light col-lg-4" style="margin-top: 2rem; margin-bottom: 1rem; width: 12rem;" name="animal">

                            <option value="1" class="text-center" selected disabled>Animal</option>
                                <?php
                                    do {

                                ?>
                                <option value="<?php echo ($nimal ['id_animal'])?>"><?php echo($nimal ['nombre'])?></option>
                            <?php
                                }while( $nimal = $animales->fetch());
                            ?>
                        </select>


                        <select class="form-control bg-light col-lg-4" name="cuna" style="margin-top: 2rem; margin-bottom: 1rem; width: 12rem;">

                            <option value="1" class="text-center" selected disabled>Vacuna</option>
                                <?php
                                    do {

                                ?>
                                <option value="<?php echo ($row ['id_vacuna'])?>"><?php echo($row ['vacuna'])?></option>
                            <?php
                                }while($row = $select->fetch());
                            ?>
                        </select>
                        <br><br>
                </div>
            </div> 



                <div class="input-group mt-4" style="gap: 50%;">
                    <a href="historial_vacs.php" class="text-decoration-none text-dark fw-semibold fst-italic input-group-text">VOLVER</a>

                    <input type="hidden" name="agre" value="tipu">
                    <button class="btn btn-danger text-white w-60 mt-4 fw-semibold shadow-sm" style="border-radius: 7%;"  type="submit">CREAR</button></td>
                </div>


            </form>
            
    </div>
</body>
</html>