<?php
require_once 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $id_curso = $_POST['id_curso'];

    // Insertar en tabla usuarios
    $stmtUser = $conexion->prepare("INSERT INTO usuarios (usuario, contraseña, nombre, email, telefono) VALUES (?, ?, ?, ?, ?)");
    $stmtUser->bind_param("sssss", $usuario, $password, $nombre, $email, $telefono);
    $stmtUser->execute();
    $stmtUser->close();

    // Insertar en tabla inscritos
    $stmtIns = $conexion->prepare("INSERT INTO inscritos (nombre_completo, email, telefono, id_curso) VALUES (?, ?, ?, ?)");
    $stmtIns->bind_param("sssi", $nombre, $email, $telefono, $id_curso);
    $stmtIns->execute();
    $stmtIns->close();

    header("Location: confirmacion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro e Inscripción</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">Registro e Inscripción a Curso</h2>
    <form action="" method="POST" class="bg-white p-4 rounded shadow">

      <div class="mb-3">
        <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
      </div>

      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
      </div>

      <div class="mb-3">
        <input type="text" name="nombre_completo" class="form-control" placeholder="Nombre completo" required>
      </div>

      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>

      <div class="mb-3">
        <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
      </div>

      <div class="mb-3">
        <select name="id_curso" class="form-select" required>
          <option value="">-- Seleccione un Curso --</option>
          <?php
          $resultado = $conexion->query("SELECT id, nombre FROM cursos");
          while ($curso = $resultado->fetch_assoc()) {
              echo "<option value='{$curso['id']}'>{$curso['nombre']}</option>";
          }
          ?>
        </select>
      </div>

      <input type="submit" value="Registrarse e Inscribirse" class="btn btn-primary w-100">
    </form>
  </div>
</body>
</html>

