<?php
include("../cnx.php");

// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDirectory = "../media/fotos/";
    $targetFileName = str_replace(' ', '', $_POST['imageName']); // Eliminar espacios del nombre de la imagen
    $targetFile = $targetDirectory . $targetFileName;
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen JPG
    if($imageFileType != "jpg") {
        echo "<script>
                    alert('Solo permite archivos JPG');
                    window.location.href = 'imagenes.php'; // Redirigir a imagenes.php
                </script>";
        exit;
    }

    // Verificar si el archivo es menor de 5 MB
    if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
        echo "<script>
                    alert('El archivo es demasiado grande. El maximo son 5mg.');
                    window.location.href = 'imagenes.php'; // Redirigir a imagenes.php
                </script>";
        exit;
    }

    // Verificar si ya existe una imagen con el mismo nombre
    $nombre = basename($targetFileName);
    $sql_check = "SELECT COUNT(*) AS count FROM imagenes WHERE nombre='$nombre'";
    $result_check = $conn->query($sql_check);
    $row_check = $result_check->fetch_assoc();

    if ($row_check["count"] > 0) {
        echo "<script>
                    alert('Ya existe una imagen con el mismo nombre.');
                    window.location.href = 'imagenes.php'; // Redirigir a imagenes.php
                </script>";
        exit;
    }

    // Renombrar el archivo y moverlo al directorio destino
    $newFileName = uniqid() . ".jpg"; // Genera un nombre único para evitar conflictos de nombres
    $destination = $targetDirectory . $newFileName;
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
        echo "<script>
                    alert('Hubo un error al subir el archivo.');
                    window.location.href = 'imagenes.php'; // Redirigir a imagenes.php
                </script>";
        exit;
    }

    // Insertar la información en la base de datos
    $src = $newFileName;

    $sql = "INSERT INTO imagenes (nombre, src) VALUES ('$nombre', '$src')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                    alert('La Imagen se ha cargado correctamente!!');
                    window.location.href = 'imagenes.php'; // Redirigir a imagenes.php
                </script>";
    } else {
        echo "Error al cargar la imagen: " . $conn->error;
    }

    $conn->close();
}

?>
