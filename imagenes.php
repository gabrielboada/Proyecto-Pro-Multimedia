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
    <h2>Subir Imagenes JPG</h2>
    <form action="imagenes_uploads.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Selecciona una imagen (JPG, máximo 5 MB):</label>
            <input type="file" id="image" name="image" accept="image/jpeg" required>
        </div>
        <div class="form-group">
            <label for="imageName">Nombre de la imagen (sin espacios):</label>
            <input type="text" id="imageName" name="imageName" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Subir Imagen" name="submit">
        </div>
    </form>
</div>


<?php
include ("../structur/footer.php");
?>