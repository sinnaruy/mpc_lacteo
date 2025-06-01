<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ingreso</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../iconos/logo.png" alt="MPC LACTEO" width="80px" height="80px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Página principal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/contacto.php">Contacto</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-dark" type="submit">Buscar</button>
      </form>
      <a href="../vista/iniciarSesion.php"><button type="submit" class="btn btn-dark ms-4">Inicio de sesión</button></a>
      <!-- Botón de cambio de tema -->
      <button type="button" class="theme-switch rounded-circle ms-3" id="themeSwitch" aria-label="Cambiar tema" style="width: 40px; height: 40px; padding: 0; border-radius: 50%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </svg>
      </button>
    </div>
  </nav>
  <!--carrusel-->
  <div id="carouselExampleFade" class="carousel slide carousel-fade">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../imagenes/vaca1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../imagenes/vaca2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../imagenes/vaca3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <br>

  <!--contenedor-->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card shadow-lg p-5 mx-auto" style="width: 90%;">
          <h1 class="mb-4">¿Quienes somos?</h1>
          <p>En MPC LÁCTEO, trabajamos junto al campo para asegurar que la leche que se produce cada día 
            sea de la mejor calidad. Usamos un modelo inteligente que analiza factores como la salud de las vacas, su 
            alimentación y el manejo del ordeño, para predecir si la leche es buena, si está en riesgo o si no es apta para el consumo.
            Así, los productores pueden tomar decisiones a tiempo, cuidar mejor su ganado y ofrecer una leche más segura y nutritiva.
          </p>
          <p>Nuestro compromiso es ayudar al productor a mejorar sin complicaciones, con herramientas prácticas pensadas para el día a día.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/tema.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var miCarrusel = document.querySelector('#carouselExampleFade');
      if (miCarrusel) {
        new bootstrap.Carousel(miCarrusel, {
          interval: 5000,
          ride: 'carousel'
        });
      }

      // Agregar el evento para Ctrl + B
      document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.keyCode === 66) {
          e.preventDefault();
          document.querySelector('input[type="search"]').focus();
        }
      });
    });
  </script>
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
      <p class="mb-0">© 2025 MPC LÁCTEO. Todos los derechos reservados.</p>
      <p class="mb-0">Contacto: contacto@mpclacteo.com</p>
    </div>
  </footer>
  <!-- Modal Sesión Expirada -->
  <div class="modal fade" id="modalExpirado" tabindex="-1" aria-labelledby="modalExpiradoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="modalExpiradoLabel">Sesión expirada</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  <?php if (isset($_GET['expirado']) && $_GET['expirado'] == 1): ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      const modal = new bootstrap.Modal(document.getElementById('modalExpirado'));
      modal.show();
    });
  </script>
  <?php endif; ?>
</body>
</html>
