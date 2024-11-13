<?php
require("FUNCIONES/menu.php");
session_start(); 
require_once("C:\laragon\www\PARTICIPO 2.0\conexionBD.php");

$idProfesor = $_SESSION['idProfesor'];

$query_institutos = $conexion->prepare(" SELECT i.idInstituto, i.nombre 
    FROM institutos i
    JOIN profesor_instituto pi ON i.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?");
$query_institutos->bind_param("i", $idProfesor);
$query_institutos->execute();
$resultado_institutos = $query_institutos->get_result();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if (isset($_POST['materia']) && isset($_POST['instituto'])) {
        $materia = $_POST['materia'];
        $idInstitutoSeleccionado = $_POST['instituto'];

        try {
            
            $query = $conexion->prepare("INSERT INTO materias (materia) VALUES (?)");
            $query->bind_param("s", $materia);
            $query->execute();

      
            $numeroMateria = $conexion->insert_id;

            $query_materia_instituto = $conexion->prepare("INSERT INTO materia_instituto (numeroMateria, idInstituto) VALUES (?, ?)");
            $query_materia_instituto->bind_param("ii", $numeroMateria, $idInstitutoSeleccionado);
            $query_materia_instituto->execute();

            
            $mensaje = "Materia dada de alta con éxito.";
            $tipoMensaje = "success";
        } catch (Exception $e) {
            $mensaje = "Error al dar de alta la materia: " . $e->getMessage();
            $tipoMensaje = "error";
        }
    }

    //Baja materia
    if (isset($_POST['baja_materia'])) {
        $idMateriaBaja = $_POST['baja_materia'];

        try {
           
            $query_baja = $conexion->prepare("DELETE FROM materias WHERE numeroMateria = ?");
            $query_baja->bind_param("i", $idMateriaBaja);
            $query_baja->execute();

            if ($query_baja->affected_rows > 0) {
                $mensaje = "Materia dada de baja con éxito.";
                $tipoMensaje = "success";
            } else {
                throw new Exception("No se pudo eliminar la materia.");
            }
        } catch (Exception $e) {
            $mensaje = "Error al dar de baja la materia: " . $e->getMessage();
            $tipoMensaje = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta y Baja de Materias</title>
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="content">
<?php require("FUNCIONES/menu.php"); ?>
<h2>Alta de Materias</h2>

<?php if (!empty($mensaje)): ?>
    <script>
        Swal.fire({
          
            icon: '<?= htmlspecialchars($tipoMensaje); ?>',
            title: '<?= htmlspecialchars($mensaje); ?>',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<form action="" method="POST">
    
    <label for="instituto">Instituto:</label>
    <select name="instituto" id="instituto" required>
        <option value="">Seleccione un instituto</option>
        <?php while ($instituto = $resultado_institutos->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($instituto['idInstituto']); ?>">
                <?= htmlspecialchars($instituto['nombre']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="materia">Nombre de la Materia:</label>
    <input type="text" name="materia" id="materia" required>

    <button type="submit">Dar de Alta</button>
</form>

<h3>Dar Baja a Materia</h3>
<form action="" method="POST">
    <!--label for="baja_materia">Seleccione una materia para dar de baja:</label!-->
    <select name="baja_materia" id="baja_materia" required>
        <option value="">Seleccione una materia</option>
        <?php 
       
        $query_todas_materias = "SELECT numeroMateria, materia FROM materias";
        $resultado_todas_materias = $conexion->query($query_todas_materias);
        
        while ($materia_row = $resultado_todas_materias->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($materia_row['numeroMateria']); ?>">
                <?= htmlspecialchars($materia_row['materia']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Dar Baja</button>
</form>

</div>
</body>
</html>