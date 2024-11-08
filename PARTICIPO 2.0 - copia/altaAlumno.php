<?php
session_start(); 
require_once("C:\laragon\www\PARTICIPO 2.0\conexionBD.php");


$idProfesor = $_SESSION ['idProfesor'];

$idInstitutoSeleccionado = null;
$numeroMateriaSeleccionada = null;
$mensaje = "";
$tipoMensaje = "";

// Consulta institutos-profesor
$query_institutos = $conexion->prepare ("SELECT i.idInstituto, i.nombre 
    FROM institutos i
    JOIN profesor_instituto pi ON i.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?
");
$query_institutos->bind_param("i", $idProfesor);
$query_institutos->execute();
$resultado_institutos = $query_institutos->get_result();

//instituto-materia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['instituto'])) {
        $idInstitutoSeleccionado = $_POST['instituto'];

        $query_materias = $conexion->prepare("
            SELECT m.numeroMateria, m.materia 
            FROM materias m
            JOIN materia_instituto mi ON m.numeroMateria = mi.numeroMateria
            WHERE mi.idInstituto = ?
        ");
        $query_materias->bind_param("i", $idInstitutoSeleccionado);
        $query_materias->execute();
        $resultado_materias = $query_materias->get_result();
    }

    // Validación
    if (isset($_POST['materia']) && !empty($idInstitutoSeleccionado)) {
        $numeroMateriaSeleccionada = $_POST['materia'];
    }

    // Procesar datos de alumno-instituto-materia
    if (isset($_POST['nombre']) && isset($idInstitutoSeleccionado) && isset($numeroMateriaSeleccionada)) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $fechaNacimiento = !empty($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null;
        $dni = !empty($_POST['dni']) ? $_POST['dni'] : null;

     
        $conexion->begin_transaction();
        try {
            // Insertar alumno
            $query_alumno = $conexion->prepare("INSERT INTO alumnos (nombre, apellido, email, fechaNacimiento, dni) VALUES (?, ?, ?, ?, ?)");
            $query_alumno->bind_param("sssss", $nombre, $apellido, $email, $fechaNacimiento, $dni);
            $query_alumno->execute();

            //  ID del alumno recién insertado
            $idAlumno = $conexion->insert_id;

            // Insertar en la tabla alumno_materia
            $query_alumno_materia = $conexion->prepare("INSERT INTO alumno_materia (idAlumno, numeroMateria) VALUES (?, ?)");
            $query_alumno_materia->bind_param("ii", $idAlumno, $numeroMateriaSeleccionada);
            $query_alumno_materia->execute();

           
            $conexion->commit();

      
            $mensaje = "Alumno dado de alta con éxito.";
            $tipoMensaje = "success";
        } catch (Exception $e) {
           
            $conexion->rollback();
            $mensaje = "Error al dar de alta el alumno: " . $e->getMessage();
            $tipoMensaje = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Alumno</title>
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="content">
<?php
require("FUNCIONES/menu.php");
?>

<h2>Alta de Alumno</h2>


<?php if (!empty($mensaje)): ?>
    <script>
        Swal.fire({
            
            icon: '<?= $tipoMensaje ?>',
            title: '<?= $mensaje ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            <?php if ($tipoMensaje === 'success'): ?>
                window.location.href = "listado_alumnos.php"; 
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

<form action="" method="POST">
    
    <label for="instituto">Instituto:</label>
    <select name="instituto" id="instituto" onchange="this.form.submit()">
        <option value="">Seleccione un instituto</option>
        <?php while ($instituto = $resultado_institutos->fetch_assoc()) : ?>
            <option value="<?= $instituto['idInstituto'] ?>" <?= ($idInstitutoSeleccionado == $instituto['idInstituto']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($instituto['nombre']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <?php if (isset($idInstitutoSeleccionado)) : ?>
        <label for="materia">Materia:</label>
        <select name="materia" id="materia">
            <option value="">Seleccione una materia</option>
            <?php while ($materia = $resultado_materias->fetch_assoc()) : ?>
                <option value="<?= $materia['numeroMateria'] ?>" <?= ($numeroMateriaSeleccionada == $materia['numeroMateria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($materia['materia']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    <?php endif; ?>


    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" required>

    <label for="email">Email (opcional):</label>
    <input type="email" name="email" id="email">

    <label for="fechaNacimiento">Fecha de Nacimiento (opcional):</label>
    <input type="date" name="fechaNacimiento" id="fechaNacimiento">

    <label for="dni">DNI (opcional):</label>
    <input type="text" name="dni" id="dni">

    <button type="submit">Dar de Alta</button>
</form>
            </div>
</body>
</html>
