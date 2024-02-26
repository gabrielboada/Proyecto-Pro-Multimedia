<?php
include("../cnx.php");

// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $podcastName = $_POST['podcastName'];
    $podcastFile = $_FILES['podcastFile'];

    // Ruta de destino para guardar el archivo de podcast
    $targetDirectory = '../media/podcast/';
    $targetFile = $targetDirectory . basename($podcastFile['name']);

    // Verificar si ya existe un podcast con el mismo nombre
    $checkQuery = "SELECT * FROM podcast WHERE nombre = '$podcastName'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "<script>
                    alert('Ya existe un podcast con el mismo nombre.');
                    window.location.href = 'podcast.php'; // Redirigir a podcast.php
                </script>";
        exit;
    }

    // Mover el archivo cargado al destino
    if (move_uploaded_file($podcastFile['tmp_name'], $targetFile)) {
        // Insertar la información en la base de datos
        $src = basename($podcastFile['name']);

        $sql = "INSERT INTO podcast (nombre, src) VALUES ('$podcastName', '$src')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('El podcast se ha cargado correctamente.');
                    window.location.href = 'podcast.php'; // Redirigir a podcast.php
                </script>";
        } else {
            echo "Error al cargar el podcast: " . $conn->error;
        }
    } else {
        echo "<script>
                    alert('Hubo un error al subir el archivo.');
                    window.location.href = 'podcast.php'; // Redirigir a podcast.php
                </script>";
    }
}

// Cerrar conexión
$conn->close();
?>
