<?php
session_start();

// Validar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../vista/inicio.php");
    exit();
}

// Tiempo máximo de inactividad en segundos (ej: 900 = 15 minutos)
$tiempo_inactivo = 900;

if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];
    if ($tiempo_transcurrido > $tiempo_inactivo) {
        session_unset();
        session_destroy();
        header("Location: ../vista/inicio.php?expirado=1"); // redirigir con mensaje
        exit();
    }
}
$_SESSION['ultimo_acceso'] = time();

// Obtener el nombre del usuario
$nombreUsuario = '';
if (isset($_SESSION['nombre1'])) {
    $nombreUsuario = $_SESSION['nombre1'];
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Página principal</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/tema.js"></script>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: rgb(196, 255, 227);">
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

  <div align="center">
    <h1 class="mt-4">¡Bienvenido<?php echo $nombreUsuario ? ', ' . htmlspecialchars($nombreUsuario) : ''; ?>!</h1>
    <h3 class="mb-5">¿Qué te gustaría hacer hoy?</h3>
  </div>

  <!--contenedor-->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card shadow-lg p-5 mx-auto" style="width: 90%;">
          <h1 class="mb-4">¿Qué hace nuestra página web?</h1>
          <p>Nuestra plataforma te ayuda a llevar el control de todo lo relacionado con la producción de leche, 
            de forma sencilla y organizada.</p>
            <p>Puedes registrar, ver, actualizar y eliminar información importante, como los datos de las vacas, 
              su alimentación, el tipo de ordeño, la salud, la calidad de la leche y mucho más. Todo está en un 
              solo lugar, fácil de usar y pensado para que cualquier productor pueda manejarlo sin complicaciones.</p>
          <p>Además, toda esta información se usa para que el sistema pueda predecir si la leche es buena, está en 
            riesgo o no es apta, ayudándote a tomar decisiones rápidas y cuidar la producción.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
        // Verifica si se presionó Ctrl + B (código 66 es la tecla 'b')
        if (e.ctrlKey && e.keyCode === 66) {
          e.preventDefault(); // Previene el comportamiento por defecto del navegador
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
  
</body>
</html>
