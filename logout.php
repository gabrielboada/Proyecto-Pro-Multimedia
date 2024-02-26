<?php
session_start();

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión, también se debe destruir la cookie de sesión.
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Finalmente, destruir la sesión.
session_destroy();

header('Location: index.php'); // Redirigir al usuario al cerrar sesión
exit;
?>
