<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GFMEDIA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inicio.php">INICIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="musica.php">MUSICA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="videos.php">VIDEOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="imagenes.php">IMAGENES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="podcast.php">PODCAST</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a class="nav-link" href="mymedia.php">MY MEDIA</a>
            </li>
        </ul>
      </form>
      <form action="logout.php" method="post">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <input type="submit" class="btn btn-outline-danger" value="Cerrar Sesión">
            </li>
        </ul>
      </form>
    </div>
  </div>
</nav>