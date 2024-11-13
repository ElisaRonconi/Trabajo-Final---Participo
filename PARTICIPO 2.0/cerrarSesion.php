<?php
session_start();
session_destroy(); // destruye la sesión actual
header("Location: login.php"); // redirige a la página de inicio de sesión
exit();
?>
