<?php
//coneccion
session_start();
require ("../controlador/conexion.php");

$db = new Database();
$con = $db -> conectar();
?>
<?php
    $sql = $con -> prepare("SELECT mascota FROM dueño");
    $sql -> execute();
?>
<?php
    if((isset($_GET["MM_insert"]))&&($_GET["MM_insert"]=="formreg"))
    {
        $cedula= $_GET['doc'];
        $nombre= $_GET['nom'];
        $edad= $_GET['age'];
        $gmail= $_GET['gmail'];
        $genero= $_GET['gener'];

        $mascota= $_GET['masc'];
        $raza= $_GET['race'];
        $edad_masc= $_GET['edad_masc'];
        $tip= $_GET['animal'];

        // constante para que cada vez que alguien se registre quede como dueño innactivo

        $est= 1;


        $validar = $con ->prepare("SELECT * FROM dueño WHERE documento ='$cedula' or comple_name ='$nombre'");
        $validar-> execute();
        $fila1 = $validar-> fetch();

        if ($cedula=="" || $nombre=="" || $edad=="" || $genero=="" || $gmail=="" || $mascota=="" || $raza=="" || $edad_masc=="" || $tip=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>windows.location="agregar_propie.php"</script>';
        }
        else if ($fila1) {
            echo '<script>alert("DOCUMENTO O dueño EXISTEN //CAMBIELOS//");</script>';
            echo '<script>windows.location="agregar_propie.php"</script>';
        }
        else 
        {
            

            $insertsql = $con -> prepare("INSERT INTO dueño (documento, comple_name, edad, genero, email, mascota, raza, edad_pet, tip_masc) VALUES ('$cedula','$nombre','$edad','$genero','$gmail', '$mascota','$raza','$edad_masc','$tip')");

            $insertsql->execute();
            
            echo '<script>alert ("Registro Exitoso,Gracias");</script>';
            echo '<script>window.location="owners_pets.php"</script>';

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
    <title>Registro</title>
</head>
<body class=" bg-dark d-flex justify-content-center align-items-center vh-200">
<div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 45rem; margin-top: 10rem; margin-bottom: 5rem;">

            
            <form class="form1" method="GET" name="form1" id="form1" autocomplete="off">

            <!--logo-->
            <div class="imagen d-flex justify-content-center ">
                <img src="../imagenes/mascotas.png" class="logo" style="height: 9rem; border-radius: 20%; margin-bottom: 2rem; " alt="Avatar Image">
            </div>

            <h1 class="text-center text-dark fs-1 fw-bold">Registro<br> </h1><br><br>
            <!--Inserta titulo-->


                <!--crea formularios-->
    
    
                <label for="doc">Documento</label>
                <input class="form-control bg-light" type="number" name="doc" min="0" pattern="\d{1,10}" id="doc" required placeholder="Digite Numero de Documento"><br>
                
                <label for="docu"> Nombre </label>
                <input class="form-control bg-light" type="text" name="nom" required placeholder="Digite su Nombre Completo"><br>

                <label for="docu"> Vacuna </label>
                <input class="form-control bg-light" type="date" name="age" max="2003-08-01" required placeholder="Digite su Edad"><br>

                <label for="docu"> tipo de vacuna </label>
                <input class="form-control bg-light" type="email" name="gmail" required placeholder="Digite su correo"><br>


            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="gener">
              
                    <option value="Masculino" class="text-center" selected disabled="">Genero</option>

                    <option value="Masculino">Masculino</option>
                    
                    <option value="Femenino">Femenino</option>
                    
                    <option value="Otro">Otro</option>

            </select><br>



            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="idusu">
              
                 <option value="">Tipo de Usuario</option>
                    <?php
                        do {

                     ?>
                    <option value="<?php echo ($sql ['id_rol'])?>"><?php echo($sql ['nombre_rol'])?></option>
                <?php
                    }while($sql = $filaaa-> fetch());
                ?>
            </select>


            <div class="d-flex gap-1 justify-content-center mt-1"><input class="btn btn-danger text-white mt-4 fw-semibold shadow-sm" style="width: 80%" type="submit" name="validar" value="REGISTRAR"></div>

            <input type="hidden" name="MM_insert" value="formreg"><br><br>

            <a href="./owners_pets.php" class="text-decoration-none text-dark fw-semibold fst-italic" style="font-size: 0.9rem;">VOLVER</a>
           
            </form>
        </div>
</html>