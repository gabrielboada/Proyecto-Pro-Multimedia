<?php
session_start(); // Iniciar la sesión al principio del script

// Verificar si hay una sesión activa
if (!isset($_SESSION['nombre']) || !isset($_SESSION['email'])) {
    // Redirigir al usuario a index.php si no ha iniciado sesión
    header('Location: index.php');
    exit;
}

// Si ha iniciado sesión, mostrar un saludo personalizado
$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];

include("cnx.php");

// Obtener el género desde la URL de manera segura
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$genre = htmlspecialchars($genre, ENT_QUOTES, 'UTF-8');

// Consulta SQL para obtener las canciones según el género
$sql = "SELECT id, artista, cancion, src FROM musica WHERE genero = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $genre);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una lista
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='musicBox'>
            <ul>
                <li>" . htmlspecialchars($row["artista"], ENT_QUOTES, 'UTF-8') . "</li>
                <li>" . htmlspecialchars($row["cancion"], ENT_QUOTES, 'UTF-8') . "</li>
                <li>
                    <audio controls class='custom-audio'>
                        <source src='media/musica/{$genre}/" . htmlspecialchars($row["src"], ENT_QUOTES, 'UTF-8') . "' type='audio/mp3'>
                    </audio>
                </li>
                <li>
                    <form action='guardar_favorito.php' method='post'>
                        <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                        <input type='hidden' name='tabla' value='musica'>
                        <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                        <button class='btnFavorito' type='submit' name='favorito'>Favorito</button>
                    </form>
                </li>
            </ul>
        </div>";
    }
} else {
    echo "No se encontraron canciones de género '{$genre}'";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
