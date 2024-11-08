<?php
function calcularPorcentajeAsistencia($idAlumno, $idMateria, $conexion) {
    // Cuenta total de clases de la materia
    $queryTotalClases = "SELECT COUNT(*) as total_clases FROM asistencias WHERE idMateria = ?";
    $stmtTotal = $conexion->prepare($queryTotalClases);
    $stmtTotal->bind_param("i", $idMateria);
    $stmtTotal->execute();
    $resultadoTotal = $stmtTotal->get_result();
    $totalClases = $resultadoTotal->fetch_assoc()['total_clases'];

    // Cuenta de asistencias del alumno en la materia
    $queryAsistencias = "SELECT COUNT(*) as asistencias FROM asistencias WHERE idAlumno = ? AND idMateria = ? AND presente = 1";
    $stmtAsistencias = $conexion->prepare($queryAsistencias);
    $stmtAsistencias->bind_param("ii", $idAlumno, $idMateria);
    $stmtAsistencias->execute();
    $resultadoAsistencias = $stmtAsistencias->get_result();
    $asistencias = $resultadoAsistencias->fetch_assoc()['asistencias'];

    // Calcular el porcentaje
    return $totalClases > 0 ? ($asistencias / $totalClases) * 100 : 0;
}
?>