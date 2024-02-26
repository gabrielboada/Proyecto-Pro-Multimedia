<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include ("header.php");
include ("../structur/menuIntranet.php");
?>



<div class="container">
        <h2>Subir Archivos MP3</h2>
        <form action="musicas_uploads.php" method="post" enctype="multipart/form-data">
            <label for="mp3File">Archivo MP3</label><br>
            <input type="file" id="mp3File" name="mp3File" accept=".mp3" required><br><br>

            <label for="songName">Nombre de la Canción o Titulo del Podcast</label><br>
            <input type="text" id="songName" name="songName" required><br><br>

            <label for="artist">Artista o Autor</label><br>
            <input type="text" id="artist" name="artist" required><br><br>

            <label>Género:</label><br>
            <input type="checkbox" id="pop" name="genre[]" value="pop">
            <label for="pop">Pop</label><br>

            <input type="checkbox" id="rock" name="genre[]" value="rock">
            <label for="rock">Rock</label><br>

            <input type="checkbox" id="reggaeton" name="genre[]" value="reggaeton">
            <label for="reggaeton">Reggaeton</label><br>

            <input type="checkbox" id="baladas" name="genre[]" value="baladas">
            <label for="baladas">Baladas</label><br>

            <input type="checkbox" id="rapytrap" name="genre[]" value="rapytrap">
            <label for="rapytrap">Rap y Trap</label><br>

            <input type="checkbox" id="podcast" name="genre[]" value="podcast">
            <label for="otras">Podcast MP3</label><br><br>

            <input type="submit" value="Subir Archivo">
        </form>
</div>






<?php
include ("../structur/footer.php");
?>
