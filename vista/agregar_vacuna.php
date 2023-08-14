<?php 
    require_once ("../controlador/conexion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php


    $select = $con -> prepare("SELECT *FROM vacunas"); 
    $select-> execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if((isset($_GET["agre"]))&&($_GET["agre"]=="tipu"))
    {
        $per= $_GET['periodo'];
        $vacuna= $_GET['vacuna'];
        $descrip= $_GET['descript'];
        


        // validar si la moto ya existe 

        $num_mot= $con->prepare("SELECT * FROM vacunas WHERE id_vacuna = '$id' or vacuna= '$vacuna'");
        $num_mot-> execute();
        $motor_num= $num_mot-> fetch();
    
        if ($vacuna=="" || $descrip=="" || $per=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>window.location="crear_vacuna.php"</script>';
        }
        elseif ($motor_num){
            echo '<script>alert("El vacuna ya existe //CAMBIELO//");</script>';
            echo '<script>windows.location="crear_vacuna.php"</script>';
        }else
        {
            $registro = $con->prepare("INSERT INTO `vacunas` (`vacuna`, `descript`, `periodo`) VALUES (?, ?, ?)");
    
            $registro->execute([$per, $vacuna, $descrip]);

            echo '<script>alert ("REGISTRO EXITOSO");</script>';
            echo '<script>window.location="vacunas.php"</script>';
        
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

    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 40rem">


        

            <form method="get" name="formreg" autocomplete="off">

            <div style="height: 5rem; margin-bottom: 2rem;"><h2 class="text-center text-dark fs-1 fw-bold"> CREAR VACUNA</h2> </div>

                <label for="">Nombre</label>
                <input type="text" class="form-control bg-light" name="vacuna" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" placeholder="Nombre de la Vacuna"><br>

                <label for="">Descripcción</label>
                <input type="text" class="form-control bg-light" name="descript" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" placeholder="Descripción de la Vacuna"><br>

                <label for="">Periodo</label>
                <input type="text" class="form-control bg-light" name="periodo" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" placeholder="Duración de la Vacuna"><br>



                <div class="input-group mt-4" style="gap: 50%;">
                    <a href="vacuna.php" class="text-decoration-none text-dark fw-semibold fst-italic input-group-text">VOLVER</a>

                    <input type="hidden" name="agre" value="tipu">
                    <button class="btn btn-danger text-white w-60 mt-4 fw-semibold shadow-sm" style="border-radius: 7%;"  type="submit">CREAR</button></td>
                </div>


            </form>
            
    </div>
</body>
</html>