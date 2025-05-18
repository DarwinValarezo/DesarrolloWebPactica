<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require_once 'includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Curso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Registrar Nuevo Curso</h2>

  <form method="POST" class="bg-white p-4 rounded shadow">
    <div class="mb-3">
      <label>Nombre del Curso</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Descripción</label>
      <textarea name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>Fecha de Inicio</label>
      <input type="date" name="fecha_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Duración (en días)</label>
      <input type="number" name="duracion" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Cupo Máximo</label>
      <input type="number" name="cupo_maximo" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Curso</button>
    <a href="formulario.php" class="btn btn-secondary ms-2">Volver</a>
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $duracion = $_POST['duracion'];
      $cupo_maximo = $_POST['cupo_maximo'];

      $sql = "INSERT INTO cursos (nombre, descripcion, fecha_inicio, duracion, cupo_maximo) 
              VALUES (?, ?, ?, ?, ?)";
      $stmt = $conexion->prepare($sql);
      $stmt->bind_param("sssii", $nombre, $descripcion, $fecha_inicio, $duracion, $cupo_maximo);

      if ($stmt->execute()) {
        echo "<div class='alert alert-success mt-3'>✅ Curso registrado con éxito.</div>";
      } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . $stmt->error . "</div>";
      }

      $stmt->close();
    }
    $conexion->close();
  ?>
</div>

</body>
</html>
