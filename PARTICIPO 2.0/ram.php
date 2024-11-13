<?php
session_start();
require_once("conexionBD.php");
require("FUNCIONES/menu.php");

$mensaje = "";
$tipoMensaje = "";

// obtener  parámetros
$query = "SELECT * FROM parametros LIMIT 1";
$resultado = $conexion->query($query);
$parametros = $resultado->fetch_assoc();

// procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nLibre = $_POST['nLibre'];
    $nRegular = $_POST['nRegular'];
    $nPromocion = $_POST['nPromocion'];
    $aLibre = $_POST['aLibre'];
    $aRegular = $_POST['aRegular'];
    $aPromocion = $_POST['aPromocion'];

    // actualizar  valores 
    $query_update = $conexion->prepare("UPDATE parametros 
        SET nLibre = ?, nRegular = ?, nPromocion = ?, aLibre = ?, aRegular = ?, aPromocion = ? ");
    $query_update->bind_param("iiiiii", $nLibre, $nRegular, $nPromocion, $aLibre, $aRegular, $aPromocion);

    if ($query_update->execute()) {
        $mensaje = "Parámetros actualizados correctamente.";
        $tipoMensaje = "success";

        // actualizar tabla 
        $resultado = $conexion->query("SELECT * FROM parametros LIMIT 1");
        $parametros = $resultado->fetch_assoc();
    } else {
        $mensaje = "Error al actualizar los parámetros.";
        $tipoMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Régimen Académico Marco</title>
    <style>
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    
    </style>
</head>
<body>
<div class="content">
    <h2>    Régimen Académico Marco    </h2>
    <?php if ($mensaje): ?>
        <p class="<?= $tipoMensaje ?>"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form action="ram.php" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Parámetro</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nota para Libre:</td>
                    <td><input type="number" name="nLibre" value="<?= htmlspecialchars($parametros['nLibre']) ?>" required></td>
                </tr>
                <tr>
                    <td>Nota para Regular:</td>
                    <td><input type="number" name="nRegular" value="<?= htmlspecialchars($parametros['nRegular']) ?>" required></td>
                </tr>
                <tr>
                    <td>Nota para Promoción:</td>
                    <td><input type="number" name="nPromocion" value="<?= htmlspecialchars($parametros['nPromocion']) ?>" required></td>
                </tr>
                <tr>
                    <td>Asistencia para Libre:</td>
                    <td><input type="number" name="aLibre" value="<?= htmlspecialchars($parametros['aLibre']) ?>" required></td>
                </tr>
                <tr>
                    <td>Asistencia para Regular:</td>
                    <td><input type="number" name="aRegular" value="<?= htmlspecialchars($parametros['aRegular']) ?>" required></td>
                </tr>
                <tr>
                    <td>Asistencia para Promoción:</td>
                    <td><input type="number" name="aPromocion" value="<?= htmlspecialchars($parametros['aPromocion']) ?>" required></td>
                </tr>
            </tbody>
        </table>
        <button type="submit">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
