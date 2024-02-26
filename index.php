<?php
include ("header.php");
?>
<br><br>
<h3 class="tittle">BIENVENIDO AL INTRANET</h3>


<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="post">
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username" required><br><br>
      
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <input type="submit" value="Iniciar Sesión">
      <p id="loginMessage"><?php if(isset($_GET['msg'])) echo $_GET['msg']; ?></p>
    </form>
  </div>

<?php
include ("../structur/footer.php");
?>
