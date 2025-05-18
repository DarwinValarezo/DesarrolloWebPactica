<?php
require_once 'includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Lista de Inscritos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
  <h3 class="mt-4">Listado de inscritos por curso</h3>
  
  <?php
    $sql = "SELECT inscritos.nombre_completo, inscritos.email, cursos.nombre AS curso, inscritos.fecha_inscripcion
            FROM inscritos 
            JOIN cursos ON inscritos.id_curso = cursos.id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table class='table mt-4'>";
        echo "<thead><tr><th>Nombre Completo</th><th>Email</th><th>Curso</th><th>Fecha Inscripción</th></tr></thead>";
        echo "<tbody>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['nombre_completo']}</td>
                    <td>{$fila['email']}</td>
                    <td>{$fila['curso']}</td>
                    <td>{$fila['fecha_inscripcion']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No hay inscripciones registradas aún.</p>";
    }
  ?>

  <a href="cursos.php" class="btn btn-secondary mt-3">Volver</a>
</body>
</html>
