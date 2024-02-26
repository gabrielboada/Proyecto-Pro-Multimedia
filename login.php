<?php
session_start();

// Verificación de credenciales (simulando una verificación de base de datos)
$correctUsername = 'admin';
$correctPassword = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $correctUsername && $password === $correctPassword) {
        $_SESSION['loggedin'] = true;
        header('Location: webmaster.php');
        exit;
    } else {
        header('Location: index.php?msg=Credenciales incorrectas. Inténtalo de nuevo.');
        exit;
    }
}
?>

