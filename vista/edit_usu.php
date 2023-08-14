<?php
//coneccion
session_start();
require ("../controlador/conexion.php");

$db = new Database();
$con = $db -> conectar();
?>
<?php
    // $sql =$con -> prepare ("SELECT * FROM rol");
    // $sql-> execute();
    // $fila= $sql-> fetch();
?>
<?php
    


$recibir= $_GET['update'];


$select = $con -> prepare("SELECT * FROM dueño WHERE documento ='".$_GET['update']."'"); 
$select-> execute();
$fila= $select-> fetch(PDO::FETCH_ASSOC);

$corre = $fila['email'];


if((isset($_GET["MM_insert"]))&&($_GET["MM_insert"]=="formreg")){

        $cedula= $_GET['doc'];
        $nombre= $_GET['nom'];
        $apellidos= $_GET['lastena'];
        $telef= $_GET['tel'];
        $direc= $_GET['addres'];
        $gmail= $_GET['gmail'];
        $genero= $_GET['gener'];


    if ($cedula=="" || $nombre=="" || $apellidos=="" || $genero=="" || $gmail=="" || $telef=="" || $direc==""){
        echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="propie.php"</script>';
    }

    else{
      $actu = $con -> prepare("UPDATE dueño SET nombres= '$nombre', apellidos = '$apellidos', email = '$gmail' , genero = '$genero', telefono = '$telef', direccion = '$direc' Where documento = '$cedula' ");
      $actu -> execute();
      echo '<script>alert ("Actualizacion Exitosa");</script>';
      echo '<script>window.location="propie.php"</script>';
      }
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../imagenes/mascotas.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo_regjosh.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <title>Edición</title>
</head>
<body class=" bg-dark d-flex justify-content-center align-items-center vh-200">
<div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 45rem; margin-top: 10rem; margin-bottom: 5rem;">

            
            <form class="form1" method="GET" name="form1" id="form1" autocomplete="off">

            <!--logo-->
            <div class="imagen d-flex justify-content-center ">
                <img src="../imagenes/mascotas.png" class="logo" style="height: 9rem; border-radius: 20%; margin-bottom: 2rem; " alt="Avatar Image">
            </div>

            <h1 class="text-center text-dark fs-1 fw-bold">Edición De <br>Usuario</h1><br><br>
            <!--Inserta titulo-->


                <!--crea formularios-->
    
    
                <label for="doc">Documento</label>
                <input class="form-control bg-light" type="number" readonly value="<?php echo $fila['documento'] ?>" name="doc" desable min="0" pattern="\d{1,10}" id="doc" required placeholder="Digite Numero de Documento"><br>
                
                <label for="docu"> Nombre </label>
                <input class="form-control bg-light" type="text" name="nom" value="<?php echo $fila['nombres'] ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" required placeholder="Digite sus Nombres"><br>

                <label for="docu"> Apellidos </label>
                <input class="form-control bg-light" value="<?php echo $fila['apellidos'] ?>" type="text" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" name="lastena" required placeholder="Digite sus Apellidos"><br>

                <label for="docu"> Telefono </label>
                <input class="form-control bg-light" type="number" value="<?php echo $fila['telefono'] ?>" name="tel" min="0" pattern="\d{1,12}" required placeholder="Digite su Numero Telefónico"><br>

                <label for="docu"> Dirección </label>
                <input class="form-control bg-light" type="text" value="<?php echo $fila['direccion'] ?>" name="addres" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" required placeholder="Digite su Dirección"><br>

                <label for="docu"> Gmail </label>
                <input class="form-control bg-light" type="text" name="gmail" value="<?php echo $corre?>" placeholder="Digite su correo"><br>


            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="gener">
              
                    <option value="<?php echo $fila['genero'] ?>" class="text-center" selected><?php echo $fila['genero'] ?></option>

                    <option value="Masculino">Masculino</option>
                    
                    <option value="Femenino">Femenino</option>
                    
                    <option value="Otro">Otro</option>


            </select><br>

            <div class="d-flex gap-1 justify-content-center mt-1"><input class="btn btn-danger text-white mt-4 fw-semibold shadow-sm" style="width: 80%" type="submit" name="validar" value="REGISTRAR"></div>

            <input type="hidden" name="MM_insert" value="formreg"><br><br>

            <a href="./propie.php" class="text-decoration-none text-dark fw-semibold fst-italic" style="font-size: 0.9rem;">VOLVER</a>
           
            </form>
        </div>
</html>