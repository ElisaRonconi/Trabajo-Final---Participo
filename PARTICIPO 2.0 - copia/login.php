<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);

$error_login = false; // Control error en el login

if (isset($_POST['usuario'], $_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Verificar exitencia y credenciales correctas
    $sql = "SELECT idProfesor FROM usuarios WHERE usuario = ? AND contraseña = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['idProfesor'] = $row['idProfesor']; // Almacena el idProfesor en la sesión

        // Obtener nombre del profesor 
        $sqlProfesor = "SELECT nombre FROM profesores WHERE idProfesor = ?";
        $stmtProfesor = $conexion->prepare($sqlProfesor);
        $stmtProfesor->bind_param('i', $row['idProfesor']);
        $stmtProfesor->execute();
        $resultProfesor = $stmtProfesor->get_result();

        if ($resultProfesor->num_rows === 1) {
            $profesor = $resultProfesor->fetch_assoc();
            $_SESSION['nombreProfesor'] = $profesor['nombre']; // Guarda el nombre del profesor en la sesión
        }

        header("Location: index.php"); // Redirige
        exit();
    } else {
        // Si las credenciales son incorrectas, establece la variable de error
        $error_login = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   <div class="welcome-text" style="
    background-image: url('IMG/classroom.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 95vh;
     object-fit: cover; /* Ajusta la imagen sin distorsionarla */
    width: 100%;
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"> 
       <main>
            <article>
                <section>
                    <form action="" method="POST">
                        <img src="IMG/participoL.png" alt="Logo" class="logo-header">
                        <h1>Inicio de Sesión</h1>
            
                        <input id="usuario" type="text" class="input" name="usuario" required placeholder="Usuario"><br/>
                        <input type="password" name="password" placeholder="Contraseña"><br/>
                        <button type="submit">Iniciar</button>

                        <p>Aún no tienes cuenta?</p>
                        <p>
                            <a href="mailto:elisamariaronconi@gmail.com?subject=Solicitud%20de%20Registro&body=Hola%20Elisa!%0A%0AQuisiera%20registrarme%20en%20el%20sistema%20Gestión%20de%20Asistencia%20Participa,%20podrías%20crear%20me%20un%20usuario?%0ANombre:%20[TuNombre]%0AApellido:%20[TuApellido]">Solicitar Usuario</a>
                        </p>
                    </form>

                    <?php if ($error_login): ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Credenciales incorrectas',
                                text: 'Por favor verifica tu usuario y contraseña.',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                    <?php endif; ?>
                </section>
            </article>
       </main>
</body>
</html>