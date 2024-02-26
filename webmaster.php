<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include ("header.php");
include ("../structur/menuIntranet.php");
?>
<br><br><br><br><br>
<img class="imgbody" src="../media/logo.jpg">





<?php
include ("../structur/footer.php");
?>
