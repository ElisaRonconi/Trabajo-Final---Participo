<?php
require ("conexionBD.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// id profesor de la sesión
$idProfesor = $_SESSION['idProfesor'];

?>