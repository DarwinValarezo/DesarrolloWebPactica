<?php
session_start();  
session_destroy();

session_start();
$_SESSION['mensaje_logout'] = "🚪 Sesión cerrada correctamente.";

header("Location: index.php");
exit();
?>
