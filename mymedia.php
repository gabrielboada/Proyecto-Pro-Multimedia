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


<!-- Menú desplegable -->
<div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h4 class="text-white">Selección Para Visualizar tus Favoritos</h4>
      <!-- Submenús -->
      <ul class="submenu">
        <li><a href="#" id="musica">Mis Canciones</a></li>
        <li><a href="#" id="videos">Mis Videos</a></li>
        <li><a href="#" id="imagenes">Mis Imágenes</a></li>
        <li><a href="#" id="podcast">Mis Podcasts</a></li>
      </ul>
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</div>

<!-- Div para mostrar los favoritos -->
<div id="misfavoritos"></div>


<?php
include ("structur/footer.php");
?>