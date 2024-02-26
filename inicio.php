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

<br><br>
<h3 class="tittle">BIENVENIDO A GFMEDIA <?php echo $nombre; ?></h3>
<img class="imgbody" src="media/logo.jpg">



<?php
include ("structur/footer.php");
?>
