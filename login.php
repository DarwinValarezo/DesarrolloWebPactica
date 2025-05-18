<?php
session_start();
require_once 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $password = $_POST['password'];

    // Verificar usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        die("Error al preparar la consulta de usuario: " . $conexion->error);
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        if (password_verify($password, $fila['contraseña'])) {
            $_SESSION['usuario'] = $fila['usuario'];
            $nombre = $fila['nombre'];

            // Obtener el curso inscrito más reciente
            $sqlCurso = "SELECT cursos.nombre AS curso
                         FROM inscritos
                         JOIN cursos ON cursos.id = inscritos.id_curso
                         WHERE inscritos.nombre_completo = ?
                         ORDER BY inscritos.fecha_inscripcion DESC
                         LIMIT 1";
            $stmtCurso = $conexion->prepare($sqlCurso);

            if ($stmtCurso) {
                $stmtCurso->bind_param("s", $nombre);
                $stmtCurso->execute();
                $resultadoCurso = $stmtCurso->get_result();

                if ($resultadoCurso->num_rows === 1) {
                    $curso = $resultadoCurso->fetch_assoc();
                    $_SESSION['mensaje'] = "🎉 Felicidades <strong>$nombre</strong>, te has inscrito en el curso: <strong>{$curso['curso']}</strong>.";
                } else {
                    $_SESSION['mensaje'] = "🎉 Bienvenido <strong>$nombre</strong>, pero aún no te has inscrito en ningún curso.";
                }
                $stmtCurso->close();
            } else {
                $_SESSION['mensaje'] = "🎉 Bienvenido <strong>$nombre</strong>. No se pudo verificar tu inscripción.";
            }

            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        $error = "❌ Usuario no encontrado.";
    }

    $stmt->close();
}
?>
