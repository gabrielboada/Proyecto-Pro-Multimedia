<?php
session_start();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['email'])) {
    // Redirigir al usuario a index.php si no ha iniciado sesión
    header('Location: index.php');
    exit;
}

// Obtener el email del usuario de la sesión
$email = $_SESSION['email'];

// Obtener el tipo de favoritos desde la solicitud GET
if (isset($_GET['tabla'])) {
    $tipo = $_GET['tabla'];
} else {
    // Si no se proporciona un tipo de favoritos, mostrar un mensaje de error
    echo "Error: No se proporcionó un tipo de favoritos.";
    exit;
}

// Validar el tipo de favoritos para evitar inyección de código
$tipos_validos = array("musica", "videos", "imagenes", "podcast");
if (!in_array($tipo, $tipos_validos)) {
    // Si el tipo de favoritos no es válido, mostrar un mensaje de error
    echo "Error: Tipo de favoritos no válido.";
    exit;
}

// Incluir el archivo de conexión a la base de datos
include("cnx.php");

// Consultar los favoritos del usuario según el tipo
$sql = "SELECT * FROM $tipo WHERE id IN (SELECT iditem FROM mymedia WHERE tabla = ? AND usuario = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $tipo, $email);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar los favoritos en una lista
    while ($row = $resultado->fetch_assoc()) {
        // Mostrar los datos según el tipo
        switch ($tipo) {
            case "musica":
                echo "
                    <div class='musicBox'>
                        <ul>
                            <li>" . htmlspecialchars($row["artista"], ENT_QUOTES, 'UTF-8') . "</li>
                            <li>" . htmlspecialchars($row["cancion"], ENT_QUOTES, 'UTF-8') . "</li>
                            <li>
                                <audio controls class='custom-audio'>
                                    <source src='media/musica/". htmlspecialchars($row["genero"], ENT_QUOTES, 'UTF-8') ."/" . htmlspecialchars($row["src"], ENT_QUOTES, 'UTF-8') . "' type='audio/mp3'>
                                </audio>
                            </li>
                            <li>
                                <form action='eliminar_favorito.php' method='post'>
                                    <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                                    <input type='hidden' name='tabla' value='musica'>
                                    <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                                    <button class='btnFavorito' type='submit' name='favorito'>Eliminar Favorito</button>
                                </form>
                            </li>
                        </ul>
                    </div>";
                break;
            case "videos":
                echo "
                    <div class='player' >
                        <form action='eliminar_favorito.php' method='post'>
                            <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='tabla' value='videos'>
                            <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                            <button class='btnFavorito' type='submit' name='favorito'>Eliminar Favorito</button>
                        </form> 
                        <iframe src='https://www.youtube.com/embed/" . $row["youtubeid"]. "' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
                        <p>" . $row["nombre"]."</p>
                    </div>";
                break;
            case "imagenes":
                echo "
                    <div class='mediaImg'>
                        <img class='thumbnail' src='media/fotos/" . $row["src"] . "' alt='Miniatura' onclick='openPopup(\"media/fotos/" . $row["src"] . "\")' />
                        <form action='eliminar_favorito.php' method='post'>
                            <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='tabla' value='imagenes'>
                            <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                            <button class='btnFavorito' type='submit' name='favorito'>Eliminar Favorito</button>
                        </form> 
                    </div>
                    <div class='popup' style='display: none;'>
                        <img src='media/fotos/" . $row["src"] . "' alt='Imagen Grande' />
                        <a class='download-btn' href='media/fotos/" . $row["src"] . "' download>Descargar</a>
                        <button class='close-btn' onclick='closePopup()'>Cerrar</button>
                    </div>
                    ";
                break;
            case "podcast":
                echo "
                    <div class='player'>
                        <form action='Eliminar_favorito.php' method='post'>
                            <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='tabla' value='podcast'>
                            <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                            <button class='btnFavorito' type='submit' name='favorito'>Eliminar Favorito</button>
                        </form> 
                        <video controls width='250' height='140'>
                            <source src='media/podcast/" . $row["src"] . "' type='video/mp4'>
                            Tu navegador no soporta la etiqueta de video.
                        </video>
                        <p style='color:white;'>" . $row["nombre"] . "</p>    
                    </div>";
                break;
            default:
                echo "Tipo de favoritos no válido.";
                break;
        }
    }
} else {
    echo "No se encontraron favoritos para este usuario y tipo.";
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>

