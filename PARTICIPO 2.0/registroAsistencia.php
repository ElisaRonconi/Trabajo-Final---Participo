<?php
require("FUNCIONES/menu.php");
require("FUNCIONES/consultas.php");

if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();}

$idProfesor = $_SESSION['idProfesor'];

//institutos-profesor
$query_institutos = $conexion->prepare("SELECT i.idInstituto, i.nombre 
    FROM institutos i
    JOIN profesor_instituto pi ON i.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?");
$query_institutos->bind_param("i", $idProfesor);
$query_institutos->execute();
$resultado_institutos = $query_institutos->get_result();

// materias-profesor 
$materias_disponibles = [];
if ($resultado_institutos && isset($_POST['instituto'])) {
    $idInstituto = $_POST['instituto'];

    $query_materias = $conexion->prepare("SELECT m.numeroMateria, m.materia 
        FROM materias m
        JOIN materia_profesor mp ON m.numeroMateria = mp.idMateria
        JOIN materia_instituto mi ON m.numeroMateria = mi.numeroMateria
        WHERE mp.idProfesor = ? AND mi.idInstituto = ?");
    $query_materias->bind_param("ii", $idProfesor, $idInstituto);
    $query_materias->execute();
    $resultado_materias = $query_materias->get_result();
    $materias_disponibles = $resultado_materias->fetch_all(MYSQLI_ASSOC);
}

// procesar cambios 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_cambios'])) {
    $fecha = $_POST['fecha'];
    $numeroMateria = $_POST['materia'];

    foreach ($_POST['asistencia'] as $idAlumno => $presente) {
        $presente = $presente ? 1 : 0;

        $query_update = $conexion->prepare("INSERT INTO asistencias (fecha, idMateria, idAlumno, presente) 
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE presente = ? ");
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

    $_POST['consultar_asistencia'] = true;
}

// eliminación de asistencias
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_asistencia_todo'])) {
    $fecha = $_POST['fecha'];
    $numeroMateria = $_POST['materia'];

    $query_delete = $conexion->prepare(" DELETE FROM asistencias 
        WHERE idMateria = ? AND fecha = ?");
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

    $_POST['consultar_asistencia'] = true;
}



// asistencia-materia-fecha 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar_asistencia'])) {
    $numeroMateria = $_POST['materia'];
    $fecha = $_POST['fecha'];

    // Verificar si hay cumpleaños hoy para alumnos de la materia seleccionada
    $query_cumple = $conexion->prepare("SELECT a.nombre, a.apellido
        FROM alumnos a
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        WHERE DAY(a.fechaNacimiento) = DAY(?) 
        AND MONTH(a.fechaNacimiento) = MONTH(?)
        AND am.numeroMateria = ?");
    $query_cumple->bind_param("ssi", $fecha, $fecha, $numeroMateria);
    $query_cumple->execute();
    $resultado_cumple = $query_cumple->get_result();
    $cumpleanieros = [];

    while ($fila = $resultado_cumple->fetch_assoc()) {
        $cumpleanieros[] = $fila['nombre'] . ' ' . $fila['apellido'];
    }

    if (!empty($cumpleanieros)) {
        $listaCumpleanieros = implode(", ", $cumpleanieros);
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Hoy es el cumpleaños de:',
                    text: '$listaCumpleanieros',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>";
    }

    // Consultar la lista de asistencias para la materia y fecha
    $query_asistencias = $conexion->prepare(" SELECT a.idAlumno, a.nombre, a.apellido, IFNULL(asi.presente, 0) AS presente
        FROM alumnos a
        LEFT JOIN asistencias asi ON a.idAlumno = asi.idAlumno AND asi.idMateria = ? AND asi.fecha = ?
        JOIN alumno_materia am ON a.idAlumno = am.idAlumno
        WHERE am.numeroMateria = ?");
    $query_asistencias->bind_param("isi", $numeroMateria, $fecha, $numeroMateria);
    $query_asistencias->execute();
    $resultado_asistencias = $query_asistencias->get_result();

    $listaAlumnos = []; 

    while ($alumno = $resultado_asistencias->fetch_assoc()) {
        $listaAlumnos[] = $alumno;   }
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
            <h3>Gestión de Asistencias</h3>

            <select name="instituto" onchange="this.form.submit()" required>
                <option value="">Seleccione un instituto</option>
                <?php while ($fila = $resultado_institutos->fetch_assoc()): ?>
                    <option value="<?= $fila['idInstituto']; ?>" <?= (isset($idInstituto) && $idInstituto == $fila['idInstituto']) ? 'selected' : ''; ?>>
                        <?= $fila['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <select name="materia" required>
                <option value="">Seleccione una materia</option>
                <?php foreach ($materias_disponibles as $materia): ?>
                    <option value="<?= $materia['numeroMateria']; ?>" <?= (isset($numeroMateria) && $numeroMateria == $materia['numeroMateria']) ? 'selected' : ''; ?>>
                        <?= $materia['materia']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="date" name="fecha" required value="<?= isset($fecha) ? $fecha : ''; ?>">
            <button type="submit" name="consultar_asistencia">Obtener Lista de Alumnos</button>
        </form>

        <?php if (!empty($listaAlumnos)): ?>
            <h3>Lista de Asistencias - <?= htmlspecialchars($fecha); ?></h3>
            <form method="post" action="">
                <input type="hidden" name="materia" value="<?= $numeroMateria; ?>">
                <input type="hidden" name="fecha" value="<?= $fecha; ?>">

                <table border="1">
                    <tr>
                        <th>Alumno</th>
                        <th>Asistencia</th>
                    </tr>
                    <?php foreach ($listaAlumnos as $alumno): ?>
                        <tr>
                            <td><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                            <td>
                                <input type="hidden" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="0">
                                <input type="checkbox" name="asistencia[<?= $alumno['idAlumno']; ?>]" value="1" <?= $alumno['presente'] ? 'checked' : ''; ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <button type="submit" name="guardar_cambios">Guardar Cambios</button><br><br>
                <button type="submit" name="eliminar_asistencia_todo" onclick="return Swal.fire({
                    icon: 'warning',
                    title: '¿Estás seguro?',
                    text: 'Esto eliminará todas las asistencias de esta fecha y materia.',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then(result => result.isConfirmed);">Eliminar Todas las Asistencias</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
