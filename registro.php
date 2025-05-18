<?php
require_once 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario   = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email     = $_POST['email'];
    $nombre    = $_POST['nombre'];
    $telefono  = $_POST['telefono'];

    $sql = "INSERT INTO usuarios (usuario, contraseña, email, nombre, telefono) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $usuario, $password, $email, $nombre, $telefono);

    if ($stmt->execute()) {
        echo "<div style='padding: 15px; background: #d4edda; color: #155724;'>✅ Usuario registrado exitosamente. <a href='login.php'>Iniciar sesión</a></div>";
    } else {
        echo "<div style='padding: 15px; background: #f8d7da; color: #721c24;'>❌ Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4">Formulario de Registro</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
