<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inicio de Sesión</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/validacionInicioSesion.js"></script>
  <script src="../js/tema.js"></script>
</head>
<body class="d-flex align-items-center" style="min-height: 90vh; padding-top: 30px; padding-bottom: 40px;">

<!-- Flechita para volver a inicio -->
<a href="../vista/inicio.php" class="position-absolute top-0 start-0 m-3" style="z-index: 1050; text-decoration: none; color:rgb(0, 0, 0);">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path fill-rule="evenodd" d="M8.354 11.354a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 0 1H5.707l2.647 2.646a.5.5 0 0 1 0 .708z"/>
    </svg>
  </a>

  <!-- Botón de tema en la esquina superior derecha -->
  <button type="button" class="theme-switch rounded-circle position-absolute top-0 end-0 m-3" id="themeSwitch" aria-label="Cambiar tema" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; z-index: 1050;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </svg>
  </button>

  <!-- Contenedor centrado -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- Logo -->
        <div class="text-center mb-4">
        <a class="navbar-brand" href="../vista/inicio.php">
          <img src="../iconos/logo.png" alt="Logo" width="150" height="150">
        </a>
        </div>

        <div class="card shadow-lg p-5">
          <!-- Título -->
          <h4 class="text-center mb-4">Inicio de sesión</h4>

          <!-- Formulario -->
          <form id="loginForm">
            <div class="mb-4">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="correo" name="correo" maxlength="50" required>
            </div>
            <div class="mb-5">
              <label for="clave" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="clave" name="clave" maxlength="8" required>
              <p><a href="../vista/recuperarContra.php" class="link">¿Olvidaste tu contraseña?</a></p>
            </div>
            <div id="error" class="text-danger text-center mb-3"></div>
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-dark">Entrar</button>
            </div>
            <div>
              <p align="center"><a href="../vista/registro.php" class="link">¿No tienes una cuenta?, registrate aquí</a></p>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/validacionInicioSesion.js"></script>
</body>
</html>
