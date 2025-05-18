<?php
require_once 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, password) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "❌ Error al registrar usuario.";
    }
}
?>
