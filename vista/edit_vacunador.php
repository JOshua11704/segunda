<?php
require_once("../controlador/conexion.php");

$db = new Database();
$con = $db->conectar();

if (isset($_GET['update'])) {
    $cil = $_GET['update'];

    $select = $con->prepare("SELECT * FROM vacunadores WHERE id_vacunador = :vacunador");
    $select->execute([':vacunador' => $cil]);
    $fila = $select->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["agre"]) && $_GET["agre"] == "tipu") {
    $id = $_GET['id'];
    $vacunador = $_GET['vacunador'];
    $especialidad = $_GET['espec'];

    $num_mot = $con->prepare("SELECT * FROM vacunadores WHERE vacunador = :vacunador");
    $num_mot->execute([':vacunador' => $vacunador]);
    $motor_num = $num_mot->fetch();

    if (empty($vacunador) || empty($especialidad)) {
        echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
        echo '<script>window.location="vacunadores.php"</script>';
    } elseif ($motor_num) {
        echo '<script>alert("El vacunador ya existe //CAMBIELO//");</script>';
        echo '<script>window.location="vacunadores.php"</script>';
    } else {
        $actualiz = $con->prepare("UPDATE vacunadores SET vacunador = :vacunador, especialidad= :especialidad WHERE id_vacunador = :id_vacunador");
        $actualiz->execute([
            ':vacunador' => $vacunador,
            ':id_vacunador' => $id,
            ':especialidad' => $especialidad
        ]);

        echo "<script>alert('Actualizacion con Exito');</script>";
        echo "<script>window.location='vacunadores.php';</script>";
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
    <title>EDITAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
</head>
<body class="bg-dark d-flex justify-content-center align-items-center vh-100" style="background-color: #C4C4C4;">

<div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 40rem">
    <form method="get" name="formreg" autocomplete="off">
        <div style="height: 5rem; margin-bottom: 2rem;">
            <h2 class="text-center text-dark fs-1 fw-bold">EDITAR VACUNADOR</h2>
        </div>
        
        <label for="">ID del Vacunador</label>
        <input type="text" class="form-control bg-light" name="id" value="<?php echo $fila['id_vacunador']; ?>" readonly><br>

        <label for="">Vacunador</label>
        <input type="text" class="form-control bg-light" name="vacunador" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" value="<?php echo $fila['vacunador']; ?>" placeholder="Cantidad de vacunador"><br>

        <label for="">Especialidad</label>
        <input type="text" class="form-control bg-light" name="espec" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{1,30}" placeholder="Especialidad del Vacunador" value="<?php echo $fila['especialidad']; ?>"><br>

        <div class="input-group mt-4" style="gap: 50%;">
            <a href="vacunadores.php" class="text-decoration-none text-dark fw-semibold fst-italic input-group-text">VOLVER</a>

            <input type="hidden" name="agre" value="tipu">
            <button class="btn btn-danger text-white w-60 mt-4 fw-semibold shadow-sm" style="border-radius: 7%;" type="submit">EDITAR</button>
        </div>
    </form>
</div>
</body>
</html>
