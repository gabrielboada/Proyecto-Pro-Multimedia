<?php
include ("structur/header.php");
include ("cnx.php");
?>


<div class="menu-index">
    <img src="media/logo.jpg"/>
    <a href="index.php"><div class="btnregistro">Iniciar Sesion</div></a>
</div>
<div class="login-container">
    <h2>Registrate</h2>
    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Registrarse">
    </form>
</div>

<?php
include ("structur/footer.php");
?>