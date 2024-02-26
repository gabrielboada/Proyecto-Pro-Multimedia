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
    <h2>Subir Videos de Youtube</h2>
    <form action="procesar_youtube.php" method="POST">
            <label for="videoName">Nombre del video:</label><br>
            <input type="text" id="videoName" name="videoName" required><br><br>
            
            <label for="youtubeID">ID de YouTube:</label><br>
            <input type="text" id="youtubeID" name="youtubeID" required><br><br>
            
            <input type="submit" value="Subir">
    </form>
</div>


<?php
include ("../structur/footer.php");
?>