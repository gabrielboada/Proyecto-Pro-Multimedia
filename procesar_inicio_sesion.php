<?php
include("cnx.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verificar el reCAPTCHA
    $recaptchaSecretKey = "6LfIj1YpAAAAAJFvGXZ23m-jb0XRosXW_NQINE4t";
    $recaptchaVerification = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}"));

    if (!$recaptchaVerification->success) {
        echo "<script>
                    alert('Error: Favor de completar el reCAPTCHA.');
                    window.location.href = 'index.php'; 
                </script>";
    } else {
        // Verificar la contraseña en la base de datos
        $getPasswordQuery = "SELECT nombre, email, password FROM usuarios WHERE email = '$email'";
        $result = $conn->query($getPasswordQuery);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $storedPasswordHash = $userData['password'];

            // Verificar la contraseña
            if (password_verify($password, $storedPasswordHash)) {
                // Contraseña correcta, puedes iniciar sesión aquí
                session_start();
                $_SESSION['nombre'] = $userData['nombre'];
                $_SESSION['email'] = $userData['email'];
                
                // Redireccionar a inicio.php
                header('Location: inicio.php');
                exit;
            } else {
                echo "<script>
                    alert('Error: Contraseña Incorrecta');
                    window.location.href = 'index.php'; 
                </script>";
            }
        } else {
            echo "<script>
                    alert('Error: El Correo electronico no esta Registrado.');
                    window.location.href = 'index.php'; 
                </script>";
        }
    }
}
?>
