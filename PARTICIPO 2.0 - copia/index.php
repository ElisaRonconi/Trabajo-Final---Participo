<?php require("FUNCIONES/menu.php"); 
require("FUNCIONES/consultas.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PARTICIPO Inicio</title>
</head>
<body>
   <style>
    body {
      background: url('IMG/classroom.jpg') no-repeat center center fixed;
      background-size: cover;
      z-index: -1;
    }

  </style>
  <section class="welcome-section">
    
    <div class="welcome-text">
      <?php require("FUNCIONES/consultas.php"); ?>
      <h2><?php echo htmlspecialchars($_SESSION['nombreProfesor']); ?></h2>
      <h1>¡Bienvenido/a!</h1><br>
      <button onclick="window.location.href='asistencia.php';">Tomar Asistencia</button>
    </div>
  </section>

  <div class="copyright">
    <p class="m-0 text-white-50">Copyright &copy; <a href="#">ERonconi</a>. Todos los derechos reservados.</p>
  </div>

 
</body>
</html>
