<?php
session_start();
require_once("conexionBD.php");
require("FUNCIONES/menu.php"); 

if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();}

$idProfesor = $_SESSION['idProfesor'];

// consulta  parametros
$query_parametros = "SELECT * FROM parametros LIMIT 1";
$resultado_parametros = $conexion->query($query_parametros);
$parametros = $resultado_parametros->fetch_assoc();

$nLibre = $parametros['nLibre'];
$nRegular = $parametros['nRegular'];
$nPromocion = $parametros['nPromocion'];
$aLibre = $parametros['aLibre'];
$aRegular = $parametros['aRegular'];
$aPromocion = $parametros['aPromocion'];

// consulta materias-profesor
$query_materias = $conexion->prepare(" SELECT m.numeroMateria, m.materia 
    FROM materias m
    JOIN materia_profesor mp ON m.numeroMateria = mp.idMateria
    WHERE mp.idProfesor = ?");
$query_materias->bind_param("i", $idProfesor);
$query_materias->execute();
$resultado_materias = $query_materias->get_result();

$alumnos = [];
$numeroMateriaSeleccionada = null;

// materia, alumnos y asistencia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['materia'])) {
        $numeroMateriaSeleccionada = $_POST['materia'];

        //consulta alumnos-notas-asistencia
        $query_alumnos = $conexion->prepare("SELECT a.idAlumno,  a.nombre,  a.apellido,  n.nota1,  n.nota2,  n.nota3,
                (SELECT COUNT(*) FROM asistencias WHERE asistencias.idAlumno = a.idAlumno AND asistencias.idMateria = ? AND asistencias.presente = 1) AS asistencias_presentes,
                (SELECT COUNT(DISTINCT fecha) FROM asistencias WHERE asistencias.idMateria = ?) AS total_clases
            FROM alumnos a
            LEFT JOIN notas n ON a.idAlumno = n.idAlumno AND n.idMateria = ?
            JOIN alumno_materia am ON a.idAlumno = am.idAlumno
            WHERE am.numeroMateria = ?");
        
        $query_alumnos->bind_param("iiii", $numeroMateriaSeleccionada, $numeroMateriaSeleccionada, $numeroMateriaSeleccionada, $numeroMateriaSeleccionada);
        if ($query_alumnos->execute()) {
            $alumnos = $query_alumnos->get_result(); }
    }
}

// condición del alumno
function calcularCondicion($promedioNotas, $porcentajeAsistencia, $nLibre, $nRegular, $nPromocion, $aLibre, $aRegular, $aPromocion) {
    if ($porcentajeAsistencia <= $aLibre || $promedioNotas < $nLibre) {
        return "Libre";
    } elseif ($porcentajeAsistencia >= $aRegular && $promedioNotas >= $nRegular && $promedioNotas < $nPromocion) {
        return "Regular";
    } elseif ($porcentajeAsistencia >= $aPromocion && $promedioNotas >= $nPromocion) {
        return "Promocionado";
    }
    return "Pendiente";
}?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Notas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="content">
<h2>Gestión de Notas</h2>
<form method="POST" action="">
   <label for="materia">Seleccione una materia:</label>
   <select name="materia" id="materia" onchange="this.form.submit()">
       <option value="">-Seleccionar materia-</option>
       <?php while ($materia = $resultado_materias->fetch_assoc()): ?>
           <option value="<?= htmlspecialchars($materia['numeroMateria']) ?>" <?= ($numeroMateriaSeleccionada == htmlspecialchars($materia['numeroMateria'])) ? 'selected' : '' ?>>
               <?= htmlspecialchars($materia['materia']) ?>
           </option>
       <?php endwhile; ?>
   </select>
</form>

<?php if ($alumnos && mysqli_num_rows($alumnos) > 0): ?>
<form id="formNotas" method="POST" action="guardar_notas_ajax.php">
   <input type="hidden" name="materia" value="<?= htmlspecialchars($numeroMateriaSeleccionada); ?>">
   <table>
       <thead>
           <tr>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Nota 1</th>
               <th>Nota 2</th>
               <th>Nota 3</th>
               <th>Porcentaje Asistencia</th>
               <th>Condición</th>
           </tr>
       </thead>
       <tbody>
           <?php while ($alumno = mysqli_fetch_assoc($alumnos)): 
               $total_clases = $alumno['total_clases'] ?? 0;
               $asistencias_presentes = $alumno['asistencias_presentes'] ?? 0;
               $porcentajeAsistencia = ($total_clases > 0) ? ($asistencias_presentes / $total_clases) * 100 : 0;
               $promedioNotas = ($alumno['nota1'] + $alumno['nota2'] + $alumno['nota3']) / 3;
               $condicion = calcularCondicion($promedioNotas, $porcentajeAsistencia, $nLibre, $nRegular, $nPromocion, $aLibre, $aRegular, $aPromocion);
           ?>

<script>
// nota esté entre 0 y 10 y solo con dos decimales
function validarNota(element) {
    const value = parseFloat(element.value);
    if (isNaN(value) || value < 0 || value > 10) {
        alert("La nota debe estar entre 0 y 10.");
        element.value = "";  
    } else {
        element.value = parseFloat(value).toFixed(2);
    }
}
function guardarNotas() {
    $.ajax({
        url: "guardar_notas_ajax.php",
        type: "POST",
        data: $("#formNotas").serialize(),
        success: function(response) {
            alert("Notas guardadas correctamente.");
            location.reload(); 
        },
        error: function() {
            alert("Error al guardar las notas.");  }
    });
}
</script>
           <tr>
               <td><?= htmlspecialchars($alumno['nombre'] ?? ''); ?></td>
               <td><?= htmlspecialchars($alumno['apellido'] ?? ''); ?></td>
                <td><input type="number" name="nota1[<?= htmlspecialchars($alumno['idAlumno'] ?? ''); ?>]" min="0" max="10" step="0.01" value="<?= htmlspecialchars($alumno['nota1'] ?? ''); ?>" onchange="validarNota(this)"></td>
                <td><input type="number" name="nota2[<?= htmlspecialchars($alumno['idAlumno'] ?? ''); ?>]" min="0" max="10" step="0.01" value="<?= htmlspecialchars($alumno['nota2'] ?? ''); ?>" onchange="validarNota(this)"></td>
                <td><input type="number" name="nota3[<?= htmlspecialchars($alumno['idAlumno'] ?? ''); ?>]" min="0" max="10" step="0.01" value="<?= htmlspecialchars($alumno['nota3'] ?? ''); ?>" onchange="validarNota(this)"></td>
               <td><?= round($porcentajeAsistencia, 2); ?>%</td>
               <td><?= htmlspecialchars($condicion); ?></td>
           </tr>
           <?php endwhile; ?>
       </tbody>
   </table>

   <button type="button" onclick="guardarNotas()">Guardar Notas</button>
</form>

<script>
function guardarNotas() {
    $.ajax({
        url: "guardar_notas_ajax.php",
        type: "POST",
        data: $("#formNotas").serialize(),
        success: function(response) {
            alert("Notas guardadas correctamente.");
            location.reload(); 
        },
        error: function() {
            alert("Error al guardar las notas.");
        }
    });
}
</script>

<?php else: ?>

<?php endif; ?>
</div>
</body>
</html>