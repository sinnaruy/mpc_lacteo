<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | MPC LÁCTEO</title>
    <link rel="icon" type="image/png" href="../iconos/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/tema.js"></script>
</head>
<body>
    <!--navbar-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: rgb(196, 255, 227);">
    <div class="container-fluid">
      <a class="navbar-brand" href="../vista/principal.php">
        <img src="../iconos/logo.png" alt="MPC LACTEO" width="80px" height="80px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/principal.php">Página principal</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestión
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../vista/hato.php">Hato</a></li>
              <li><a class="dropdown-item" href="../vista/limpieza.php">Limpieza</a></li>
              <li><a class="dropdown-item" href="../vista/tipo_suelo.php">Tipo de Suelos</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transaccionales
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../vista/corral.php">Corral</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/contacto.php">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/perfil.php">Perfil</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-dark" type="submit">Buscar</button>
      </form>
      <a href="../vista/inicio.php"><button type="submit" class="btn btn-dark ms-5">Cerrar sesión</button></a>
      <!-- Botón de cambio de tema -->
      <button type="button" class="theme-switch rounded-circle ms-3" id="themeSwitch" aria-label="Cambiar tema" style="width: 40px; height: 40px; padding: 0; border-radius: 50%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </svg>
      </button>
    </div>
  </nav>

    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 text-center">
                <h1 class="fw-bold mb-3">Contáctanos</h1>
                <p class="lead text-muted">¿Tienes dudas, sugerencias o quieres saber más sobre nuestros servicios? ¡Estamos para ayudarte!</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg p-4">
                    <h4 class="mb-3">Información de la Empresa</h4>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Nombre:</strong> MPC LÁCTEO</li>
                        <li><strong>Dirección:</strong> Calle 123 #12-34, Medellín, Colombia</li>
                        <li><strong>Teléfono:</strong> +57 317 865 4321</li>
                        <li><strong>Correo:</strong> contacto@mpclacteo.com</li>
                        <li><strong>Horario:</strong> Lunes a Viernes, 8:00 a 18:00</li>
                    </ul>
                    <p class="mb-0 text-muted">Nuestro equipo está listo para atenderte y resolver cualquier inquietud.</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg p-4 h-100">
                    <h4 class="mb-3">Ubicación</h4>
                    <div class="ratio ratio-16x9 rounded">
                        <iframe src="https://www.google.com/maps?q=Medellin&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">© 2025 MPC LÁCTEO. Todos los derechos reservados.</p>
            <p class="mb-0">Contacto: contacto@mpclacteo.com</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>