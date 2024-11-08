<?php
function calcularCondicionAlumno($idAlumno, $idMateria, $conexion) {
    // Obtener las notas del alumno
    $queryNotas = "SELECT nota1, nota2, nota3 FROM notas WHERE idAlumno = ? AND idMateria = ?";
    $stmtNotas = $conexion->prepare($queryNotas);
    $stmtNotas->bind_param("ii", $idAlumno, $idMateria);
    $stmtNotas->execute();
    $resultadoNotas = $stmtNotas->get_result();
    $notas = $resultadoNotas->fetch_assoc();

    $promedio = array_sum($notas) / count(array_filter($notas)); // Evita valores NULL

    // Obtener el porcentaje de asistencia
    $porcentajeAsistencia = calcularPorcentajeAsistencia($idAlumno, $idMateria, $conexion);

    // Obtener los valores de la tabla parámetros
    $queryParametros = "SELECT * FROM parametros";
    $resultadoParametros = $conexion->query($queryParametros);
    $parametros = $resultadoParametros->fetch_assoc();

    // Determinar la condición según los parámetros
    if ($porcentajeAsistencia >= $parametros['aPromocion'] && $promedio >= $parametros['nPromocion']) {
        return 'Promocionado';
    } elseif ($porcentajeAsistencia >= $parametros['aRegular'] && $promedio >= $parametros['nRegular']) {
        return 'Regular';
    } else {
        return 'Libre';
    }
}
?>