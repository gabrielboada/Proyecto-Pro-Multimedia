<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bienvenido Web Master</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Herramientas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="webmaster.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="musicas.php">Cargar Musica</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="videos.php">Cargar Videos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="imagenes.php">Cargar Imagenes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="podcast.php">Cargar Podcast</a>
          </li>
        </ul>
        <br>
        <br>
        <form action="logout.php" method="post">
             <input type="submit" class="btn btn-outline-danger" value="Cerrar Sesión">
        </form>
      </div>
    </div>
  </div>
</nav>