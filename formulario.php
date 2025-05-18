<?php require_once 'includes/conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Inscripción</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Inscribirse en un Curso</h2>
    <form action="inscribir.php" method="POST" class="p-4 bg-white rounded shadow">
      <div class="mb-3">
        <label>Nombre completo</label>
        <input type="text" name="nombre_completo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
      </div>
      <div class="mb-3">
        <label>Curso</label>
        <select name="id_curso" class="form-select" required>
          <option value="">-- Seleccione --</option>
          <?php
            $resultado = $conexion->query("SELECT id, nombre FROM cursos");
            while ($curso = $resultado->fetch_assoc()) {
              echo "<option value='{$curso['id']}'>{$curso['nombre']}</option>";
            }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary w-100">Inscribirse</button>
    </form>
  </div>
</body>
</html>
