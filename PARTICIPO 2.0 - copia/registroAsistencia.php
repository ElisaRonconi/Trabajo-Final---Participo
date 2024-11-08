<?php
require("FUNCIONES/menu.php");
require("FUNCIONES/consultas.php");

if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

$idProfesor = $_SESSION['idProfesor'];

// Consulta materias_profesor
$query_materias = $conexion->prepare("
    SELECT m.numeroMateria, m.materia 
    FROM materias m
    JOIN materia_profesor mp ON m.numeroMateria = mp.idMateria
    WHERE mp.idProfesor = ?
");
$query_materias->bind_param("i", $idProfesor);
$query_materias->execute();
$resultado_materias = $query_materias->get_result();

// Procesar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_cambios'])) {
    $fecha = $_POST['fecha'];
    $numeroMateria = $_POST['materia'];

    foreach ($_POST['asistencia'] as $idAlumno => $presente) {
        $presente = $presente ? 1 : 0;

        //Consulta para actualizar base de datos
        $query_update = $conexion->prepare("
            INSERT INTO asistencias (fecha, idMateria, idAlumno, presente) 
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE presente = ?
        ");
        $query_update->bind_param("siiii", $fecha, $numeroMateria, $idAlumno, $presente, $presente);
        $query_update->execute();
    }


    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Cambios guardados con éxito',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";

    // mostrar la tabla actualizada
    $_POST['consultar_asistencia'] = true;
}

// procesar la eliminación en bloque de asistencia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_asistencia_todo'])) {
    $fecha = $_POST['fecha'];
    $numeroMateria = $_POST['materia'];

    // queri para eliminar todos los registros de asistencia
    $query_delete = $conexion->prepare("
        DELETE FROM asistencias 
        WHERE idMateria = ? AND fecha = ?
    ");
    $query_delete->bind_param("is", $numeroMateria, $fecha);
    $query_delete->execute();

   
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Todas las asistencias eliminadas con éxito',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";

    // volver a consultar la asistencia para actualizar la tabla
    $_POST['consultar_asistencia'] = true;
}

// Consultar  asistencias-materia-fecha 
$mostrar_alerta_no_asistencia = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar_asistencia'])) {
    $numeroMateria = $_POST['materia'];
    $fecha = $_POST['fecha'];

    $query_asistencias = $conexion->prepare("
        SELECT a.idAlumno, a.nombre, a.apellido, IFNULL(asi.presente, 0) AS presente 
        FROM alumnos a
        LEFT JOIN asistencias asi ON a.idAlumno = asi.idAlumno AND asi.idMateria = ? AND asi.fecha = ?
        WHERE a.idAlumno IN (
            SELECT am.idAlumno FROM alumno_materia am WHERE am.numeroMateria = ?
        )
    ");
    $query_asistencias->bind_param("isi", $numeroMateria, $fecha, $numeroMateria);
    $query_asistencias->execute();
    $resultado_asistencias = $query_asistencias->get_result();

    // Verificar si existen registros de asistencia para mostrar o no la tabla
    if ($resultado_asistencias->num_rows === 0) {
        $mostrar_alerta_no_asistencia = true;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="content">
    <div class="registro-asistencia-container">
        <form class="form-box" method="post" action="">
            <h3>Consultar Asistencia</h3>

            <select name="materia" required>
                <option value="">Seleccione una materia</option>
                <?php while ($fila = $resultado_materias->fetch_assoc()): ?>
                    <option value="<?= $fila['numeroMateria']; ?>" <?= (isset($numeroMateria) && $numeroMateria == $fila['numeroMateria']) ? 'selected' : ''; ?>>
                        <?= $fila['materia']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="date" name="fecha" required value="<?= isset($fecha) ? $fecha : ''; ?>">

            <button type="submit" name="consultar_asistencia">Consultar Asistencia</button>
        </form>

        <?php if ($mostrar_alerta_no_asistencia): ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'No hay asistencia registrada',
                    text: 'No hubo asistencias registradas para esta fecha y materia.',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                });
            </script>
        <?php elseif (isset($resultado_asistencias) && $resultado_asistencias->num_rows > 0): ?>
         
            <h3>Lista de Asistencias - <?= htmlspecialchars($fecha); ?></h3>
            <form method="post" action="">
                <input type="hidden" name="materia" value="<?= $numeroMateria; ?>">
                <input type="hidden" name="fecha" value="<?= $fecha; ?>">

                <table border="1">
                    <tr>
                        <th>Alumno</th>
                        <th>Asistencia</th>
                    </tr>
                    <?php while ($alumno = $resultado_asistencias->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                            <td>
                                <input type="hidden" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="0">
                                <input type="checkbox" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="1" <?= $alumno['presente'] ? 'checked' : ''; ?>>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>

                <button type="submit" name="guardar_cambios">Guardar Cambios</button><br><br>
                <button type="submit" name="eliminar_asistencia_todo" onclick="return confirm('¿Estás seguro de que deseas eliminar todas las asistencias de esta fecha y materia?')">Eliminar Todas las Asistencias</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
