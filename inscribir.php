<?php
require_once 'includes/conexion.php';
$nombre = $_POST['nombre_completo'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$id_curso = $_POST['id_curso'];

$sql = "INSERT INTO inscritos (nombre_completo, email, telefono, id_curso)
        VALUES (?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssi", $nombre, $email, $telefono, $id_curso);
if ($stmt->execute()) {
    header("Location: confirmacion.php");
    exit();
} else {
    echo "❌ Error al inscribir: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>