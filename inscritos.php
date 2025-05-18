<?php
require_once 'includes/conexion.php';

// Consulta para obtener los inscritos y el nombre del curso relacionado
$sql = "SELECT 
            inscritos.nombre_completo, 
            inscritos.email, 
            cursos.nombre AS curso, 
            inscritos.fecha_inscripcion 
        FROM inscritos 
        INNER JOIN cursos ON inscritos.id_curso = cursos.id";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Inscritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">📋 Lista de Inscritos</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                            <td><?= htmlspecialchars($fila['email']) ?></td>
                            <td><?= htmlspecialchars($fila['curso']) ?></td>
                            <td><?= htmlspecialchars($fila['fecha_inscripcion']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">No hay inscripciones registradas aún.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Volver al inicio</a>
        </div>
    </div>
</body>
</html>

