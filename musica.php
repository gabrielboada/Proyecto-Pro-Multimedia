<?php
session_start();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['email'])) {
    // Redirigir al usuario a index.php si no ha iniciado sesión
    header('Location: index.php');
    exit;
}

// Si ha iniciado sesión, mostrar un saludo personalizado
$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];

include ("structur/header.php");
include ("structur/menu.php");
include ("cnx.php");
?>


<div class="btn-group" role="group">
  <button type="button" class="btn btn-secondary genre-button" data-genre="pop">Pop</button>
  <button type="button" class="btn btn-secondary genre-button" data-genre="rock">Rock</button>
  <button type="button" class="btn btn-secondary genre-button" data-genre="reggaeton">Reggaeton</button>
  <button type="button" class="btn btn-secondary genre-button" data-genre="baladas">Baladas</button>
  <button type="button" class="btn btn-secondary genre-button" data-genre="rapytrap">Rap & Trap</button>
  <button type="button" class="btn btn-secondary genre-button" data-genre="podcast">Podcast MP3</button>
</div>


<div id="resultado"></div>


<?php
include ("structur/footer.php");
?>
