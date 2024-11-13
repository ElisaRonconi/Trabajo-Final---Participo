<?php
require_once("conexionBD.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroMateriaSeleccionada = $_POST['materia'];

    foreach ($_POST['nota1'] as $idAlumno => $nota1) {
        $nota2 = $_POST['nota2'][$idAlumno] ?? null;
        $nota3 = $_POST['nota3'][$idAlumno] ?? null;

        // verificar existencia
        $query = "SELECT * FROM notas WHERE idAlumno = ? AND idMateria = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $idAlumno, $numeroMateriaSeleccionada);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // si ya existe
            $updateQuery = "UPDATE notas SET nota1 = ?, nota2 = ?, nota3 = ? WHERE idAlumno = ? AND idMateria = ?";
            $updateStmt = $conexion->prepare($updateQuery);
            $updateStmt->bind_param("ddiii", $nota1, $nota2, $nota3, $idAlumno, $numeroMateriaSeleccionada);
            $updateStmt->execute();
        } else {
            // si no existe
            $insertQuery = "INSERT INTO notas (idAlumno, idMateria, nota1, nota2, nota3) VALUES (?, ?, ?, ?, ?)";
            $insertStmt = $conexion->prepare($insertQuery);
            $insertStmt->bind_param("iiddi", $idAlumno, $numeroMateriaSeleccionada, $nota1, $nota2, $nota3);
            $insertStmt->execute();
        }
    }
    echo "success";
}

 // validar nota entre 0 y 10 y  solo dos decimales
foreach ($_POST['nota1,nota2,nota3'] as $idAlumno => $nota) {
    if (!preg_match('/^(10|[0-9](\.\d{1,2})?)$/', $nota)) {
        echo json_encode(['error' => 'Las notas deben estar entre 0 y 10 y con hasta dos decimales.']);
        exit;
    }
}

?>
