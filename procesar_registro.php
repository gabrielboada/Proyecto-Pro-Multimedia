<?php
include("cnx.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Verificar si el correo electrónico ya existe en la base de datos
    $checkQuery = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>
                    alert('El correo electronico ya esta registrado.');
                    window.location.href = 'registro.php'; // Redirigir a registro.php
                </script>";
        exit;
    }

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES ('$nombre', '$apellido', '$email', '$password')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "<script>
                    alert('Felicidades!! Ahora puedes Iniciar Sesion.');
                    window.location.href = 'index.php'; // Redirigir a index.php
                </script>";
        exit;
    } else {
        echo "<script>
                    alert('Error en el Registro');
                    window.location.href = 'registro.php'; // Redirigir a registro.php
                </script>";
        exit;
    }
}
?>
