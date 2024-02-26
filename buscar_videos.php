<?php
include ("cnx.php");


// Consulta SQL para obtener los videos
$sql = "SELECT id, nombre, youtubeid FROM videos";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una lista

    while($row = $result->fetch_assoc()) {
        echo "
        <div class='player' >
            <form action='guardar_favorito.php' method='post'>
                <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                <input type='hidden' name='tabla' value='videos'>
                <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                <button class='btnFavorito' type='submit' name='favorito'>Favorito</button>
            </form> 
            <iframe src='https://www.youtube.com/embed/" . $row["youtubeid"]. "' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>
            <p>" . $row["nombre"]."</p>
        </div>";
    }

} else {
    echo "No se encontraron videos";
}

// Cerrar conexión
$conn->close();
?>