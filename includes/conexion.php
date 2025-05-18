<?php
$conexion = new mysqli("localhost", "root", "", "bd_cursos");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}
?>