<?php
require("FUNCIONES\menu.php");
include("conexionBD.php"); 
session_start();

$idAlumno = $_GET['id'] ?? null;

if ($idAlumno) {
    $query = "SELECT nombre, apellido, email, fechaNacimiento, dni FROM alumnos WHERE idAlumno = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idAlumno);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $alumno = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $fechaNacimiento = !empty($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null;
    $dni = !empty($_POST['dni']) ? $_POST['dni'] : null;

     // longitud para el DNI 
     if (strlen($dni) > 15) {
        echo "<script>
            alert('Error: El DNI no puede tener más de 15 caracteres.');
            window.history.back();
        </script>";
        exit;
    }

    // actualizar  datos 
    $query_update = "UPDATE alumnos SET nombre = ?, apellido = ?, email = ?, fechaNacimiento = ?, dni = ? WHERE idAlumno = ?";
    $stmt_update = $conexion->prepare($query_update);
    $stmt_update->bind_param("sssssi", $nombre, $apellido, $email, $fechaNacimiento, $dni, $idAlumno);

    if ($stmt_update->execute()) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Datos del alumno actualizados con éxito",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "listado_alumnos.php";
            });
        </script>';
    } else {
        echo "Error al actualizar los datos del alumno.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
</head>
<body>
<div class="content">



<form action="" method="POST">
<div class="container">
    <h2>Editar Datos del Alumno</h2>
    <form action="editar_alumno.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= isset($alumno['nombre']) ? $alumno['nombre'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?= isset($alumno['apellido']) ? $alumno['apellido'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= isset($alumno['email']) ? $alumno['email'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechaNacimiento" value="<?= isset($alumno['fechaNacimiento']) ? $alumno['fechaNacimiento'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" value="<?= isset($alumno['dni']) ? $alumno['dni'] : '' ?>">
        </div>
        <div class="button-container">
            <button type="submit">Actualizar Datos</button>
        </div>
    </form>
</div>

</div>
</body>
</html>
