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
    <h2>Subir Podcast MP4</h2>
    <form id="uploadForm" action="podcast_uploads.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="podcastName">Nombre del Podcast:</label>
            <input type="text" id="podcastName" name="podcastName" required>
        </div>
        <div class="form-group">
            <label for="podcastFile">Archivo MP4 del Podcast:</label>
            <input type="file" id="podcastFile" name="podcastFile" accept="video/mp4" required>
        </div>
        <div class="form-group">
            <progress id="progressBar" value="0" max="100"></progress>
        </div>
        <div class="form-group">
            <input type="submit" value="Subir Podcast" name="submit" id="submitBtn" disabled>
        </div>
    </form>
</div>

<script>
    // Escuchar el evento 'change' en el input de archivo
    document.getElementById('podcastFile').addEventListener('change', function() {
        // Habilitar el botón de enviar cuando se seleccione un archivo
        document.getElementById('submitBtn').disabled = false;
    });

    // Escuchar el evento 'progress' durante la carga del archivo
    document.getElementById('uploadForm').addEventListener('progress', function(event) {
        // Calcular el porcentaje de progreso
        var percent = (event.loaded / event.total) * 100;
        // Actualizar la barra de progreso
        document.getElementById('progressBar').value = percent;
    });
</script>


<?php
include ("../structur/footer.php");
?>