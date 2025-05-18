<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sistema de Inscripción</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
    .card {
      background-color: rgba(255, 255, 255, 0.95);
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center">

  <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success text-center w-100">
      <?= $_SESSION['mensaje'] ?>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
  <?php endif; ?>

  <div class="container">
    <div class="card shadow p-5 mx-auto text-center" style="max-width: 500px;">
      <h2 class="mb-4">🎓 Bienvenido al Sistema de Inscripción</h2>

      <?php if (isset($_SESSION['usuario'])): ?>
        <div class="alert alert-info">
          Has iniciado sesión como <strong><?= $_SESSION['usuario'] ?></strong>.
        </div>
        <a href="logout.php" class="btn btn-danger w-100 mb-3">🚪 Cerrar Sesión</a>
      <?php else: ?>
        <p class="text-success fw-bold"> Puedes registrarte e inscribirte en un curso o iniciar sesión si ya tienes cuenta.</p>

        <a href="registro.php" class="btn btn-success w-100 mb-3">📝 Registrarse e Inscribirse</a>

        <form action="login.php" method="POST" class="text-start mt-4">
          <h5>🔐 Iniciar Sesión</h5>
          <div class="mb-2">
            <input type="text" name="username" class="form-control" placeholder="Usuario" required>
          </div>
          <div class="mb-2">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
      <?php endif; ?>

      <a href="inscritos.php" class="btn btn-outline-secondary mt-4 w-100">📋 Ver Lista de Inscritos</a>
    </div>
  </div>

</body>
</html>
