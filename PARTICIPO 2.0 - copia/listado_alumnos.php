<?php
require("FUNCIONES/menu.php");
include("conexionBD.php");
session_start();

$idProfesor = $_SESSION['idProfesor'];


$query_materias = "
    SELECT m.numeroMateria, m.materia 
    FROM materias m
    JOIN materia_profesor mp ON m.numeroMateria = mp.idMateria
    WHERE mp.idProfesor = ?
";
$stmt_materias = $conexion->prepare($query_materias);
$stmt_materias->bind_param("i", $idProfesor);
$stmt_materias->execute();
$resultado_materias = $stmt_materias->get_result();

// Procesar eliminación 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_alumno'])) {
    $idAlumno = $_POST['idAlumno'];

    // query para eliminar de la base de datos
    $query_delete = $conexion->prepare("DELETE FROM alumnos WHERE idAlumno = ?");
    $query_delete->bind_param("i", $idAlumno);
    $query_delete->execute();

    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Alumno eliminado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Redireccionar o actualizar la página
            });
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos por Materia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="content">
<div class="container">
<h2>Seleccionar Materia para Listar Alumnos</h2>

<div class="form-group">
<form action="" method="GET">
    <label for="numeroMateria">Materia:</label>
    <select name="numeroMateria" id="numeroMateria" required>
        <option value="">Seleccione una materia</option>
        <?php while ($materia = $resultado_materias->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($materia['numeroMateria']) ?>">
                <?= htmlspecialchars($materia['materia']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Ver Alumnos</button>
</form>
</div>
</div>

<?php

if (isset($_GET['numeroMateria'])):
    $numeroMateria = $_GET['numeroMateria'];

   
    $query_alumnos = "
        SELECT a.idAlumno, a.nombre, a.apellido, a.email, a.fechaNacimiento, a.dni
        FROM alumnos a
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        WHERE am.numeroMateria = ?
    ";
    $stmt = $conexion->prepare($query_alumnos);
    $stmt->bind_param("i", $numeroMateria);
    $stmt->execute();
    $resultado_alumnos = $stmt->get_result();
?>

<h2>Listado de Alumnos para la Materia Seleccionada</h2>
<div class="tablas">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de Nacimiento</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($alumno = $resultado_alumnos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($alumno['idAlumno']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                <td><?= htmlspecialchars($alumno['apellido']) ?></td>
                <td><?= htmlspecialchars($alumno['email'] ?? 'No registrado') ?></td>
                <td><?= htmlspecialchars($alumno['fechaNacimiento'] ?? 'No registrado') ?></td>
                <td><?= htmlspecialchars($alumno['dni'] ?? 'No registrado') ?></td>
                <td>
                    
                    <a href="editar_alumno.php?id=<?= $alumno['idAlumno'] ?>" class="btn-edit">Editar Alumno</a>

                  
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="idAlumno" value="<?= $alumno['idAlumno'] ?>">
                        <button type="button" onclick="confirmDelete(<?= $alumno['idAlumno'] ?>)">Eliminar Alumno</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

<script>
// Función de confirmación 
function confirmDelete(idAlumno) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear formulario para enviar eliminación de alumno
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            
            const inputIdAlumno = document.createElement('input');
            inputIdAlumno.type = 'hidden';
            inputIdAlumno.name = 'idAlumno';
            inputIdAlumno.value = idAlumno;
            form.appendChild(inputIdAlumno);

            const inputEliminar = document.createElement('input');
            inputEliminar.type = 'hidden';
            inputEliminar.name = 'eliminar_alumno';
            inputEliminar.value = '1';
            form.appendChild(inputEliminar);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

<?php endif; ?>
</div>
</body>
</html>
