<?php
include ("cnx.php");

// Consulta SQL para obtener los podcast
$sql = "SELECT id, nombre, src FROM podcast";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una lista
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='player'>
            <form action='guardar_favorito.php' method='post'>
                <input type='hidden' name='item_id' value='" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "'>
                <input type='hidden' name='tabla' value='podcast'>
                <input type='hidden' name='email_usuario' value='" . $_SESSION['email'] . "'>
                <button class='btnFavorito' type='submit' name='favorito'>Favorito</button>
            </form> 
            <video controls width='250' height='140'>
                <source src='media/podcast/" . $row["src"] . "' type='video/mp4'>
                Tu navegador no soporta la etiqueta de video.
            </video>
            <p style='color:white;'>" . $row["nombre"] . "</p>    
        </div>";
    }
} else {
    echo "No se encontraron podcast";
}

// Cerrar conexión
$conn->close();
?>