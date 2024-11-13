
<?php
include_once ('C:\laragon\www\PARTICIPO 2.0\conexionBD.php');

$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    try {
        $query = $conexion->prepare("INSERT INTO institutos (nombre, direccion) VALUES (?, ?)"
        );
        $query->bind_param("ss", $nombre, $direccion);
      
        if ($query->execute()) {
            $mensaje = "Instituto creado con éxito";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al dar de alta el instituto: " . $query->error;
            $tipoMensaje = "error";
        }
    } catch (Exception $e) {
        $mensaje = "Error al dar de alta el instituto: " . $e->getMessage();
        $tipoMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Instituto</title>
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="content">
<?php
require ("FUNCIONES\menu.php")
?>

<?php if (!empty($mensaje)): ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: '<?= $tipoMensaje ?>',
            title: '<?= $mensaje ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            <?php if ($tipoMensaje === 'success'): ?>
                window.location.href = "listado_institutos.php";
            <?php endif; ?>
        });
    </script>
<?php endif; ?>


<h2>Alta de Instituto</h2>
<form action="" method="POST">
    <label for="nombre">Nombre del Instituto:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>

    <button type="submit">Dar de Alta</button>
</form>
    </div>
</body>
</html>
