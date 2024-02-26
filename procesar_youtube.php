<?php
include("../cnx.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $videoName = $_POST['videoName'];
    $youtubeID = $_POST['youtubeID'];

    // Verificar si el ID de YouTube ya existe en la base de datos
    $checkQuery = "SELECT * FROM videos WHERE youtubeid = '$youtubeID'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>
                    alert('El ID de youtube ya existe en la base de datos.');
                    window.location.href = 'videos.php'; // Redirigir a videos.php
                </script>";
        exit;
    }

    // Insertar datos en la base de datos
    $insertQuery = "INSERT INTO videos (nombre, youtubeid) VALUES ('$videoName', '$youtubeID')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "<script>
                    alert('El Video de youtube se ha subido correctamente.');
                    window.location.href = 'videos.php'; // Redirigir a videos.php
                </script>";
        exit;
    } else {
        echo "<script>
                    alert('Error al subir video de youtube.');
                    window.location.href = 'videos.php'; // Redirigir a videos.php
                </script>";
        exit;
    }
}
?>
 