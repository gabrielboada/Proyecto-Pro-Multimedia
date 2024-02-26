<?php
include("../cnx.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $songName = $_POST['songName'];
    $artist = $_POST['artist'];
    $genres = $_POST['genre']; // Array de géneros seleccionados

    $fileName = $_FILES['mp3File']['name'];
    $fileSize = $_FILES['mp3File']['size'];
    $fileTmpName = $_FILES['mp3File']['tmp_name'];
    $fileType = $_FILES['mp3File']['type'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExt !== 'mp3') {
        echo "<script>
                    alert('Solo se permiten Archivos MP3');
                    window.location.href = 'musicas.php'; // Redirigir a musicas.php
                </script>";
        exit;
    }


    // Generar un nombre aleatorio para el archivo
    function generateRandomString($length = 5) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    $randomFileName = generateRandomString() . '_' . $fileName;

    // Ruta base para las carpetas de género
    $baseDirectory = '../media/musica/';

    // Verificar si el directorio de género existe, si no, crearlo
    $genreDirectory = '';
    if (in_array('pop', $genres)) {
        $genreDirectory = 'pop/';
    } elseif (in_array('rock', $genres)) {
        $genreDirectory = 'rock/';
    } elseif (in_array('reggaeton', $genres)) {
        $genreDirectory = 'reggaeton/';
    } elseif (in_array('baladas', $genres)) {
        $genreDirectory = 'baladas/';
    } elseif (in_array('rapytrap', $genres)) {
        $genreDirectory = 'rapytrap/';
    } else {
        $genreDirectory = 'podcast/';
    }

    $uploadDirectory = $baseDirectory . $genreDirectory;

    // Crear la carpeta de género si no existe
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uploadFilePath = $uploadDirectory . $randomFileName;

    // Mover el archivo cargado a la carpeta de género
    if (!move_uploaded_file($fileTmpName, $uploadFilePath)) {
        echo "<script>
                    alert('Hubo un error al subir el archivo.');
                    window.location.href = 'musicas.php'; // Redirigir a musicas.php
                </script>";
        exit;
    }

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO musica (artista, cancion, src, genero) VALUES ('$artist', '$songName', '$randomFileName', '" . implode(", ", $genres) . "')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "<script>
                    alert('La cancion se ha subido correctamente.');
                    window.location.href = 'musicas.php'; // Redirigir a musicas.php
                </script>";
        exit;
    } else {
        header('Location: musicas.php?msg=Error: ' . $insertQuery . '<br>' . $conn->error);
        exit;
    }
}
?>
