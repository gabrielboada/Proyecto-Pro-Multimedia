<?php
include ("cnx.php");


// Consulta SQL para obtener las imagenes
$sql = "SELECT id, nombre, src FROM imagenes";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una lista

    while($row = $result->fetch_assoc()) {
        echo "
        <div class='mediaImg'>
            <img class='thumbnail' src='media/fotos/" . $row["src"] . "' alt='Miniatura' onclick='openPopup(\"media/fotos/" . $row["src"] . "\")' />
            <form action='guardar_favorito.php' method='post'>
                <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                <input type='hidden' name='tabla' value='imagenes'>
                <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                <button class='btnFavorito' type='submit' name='favorito'>Favorito</button>
            </form> 
        </div>
        <div class='popup' style='display: none;'>
            <img src='media/fotos/" . $row["src"] . "' alt='Imagen Grande' />
            <a class='download-btn' href='media/fotos/" . $row["src"] . "' download>Descargar</a>
            <button class='close-btn' onclick='closePopup()'>Cerrar</button>
        </div>
        ";
    }

} else {
    echo "No se encontraron imagenes";
}

// Cerrar conexión
$conn->close();
?>