<?php
include "../conexion/conexion.php";

$listarUsuario = null;

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    $sql = "SELECT * FROM usuario WHERE documento = '$documento' AND estado = 'A'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $listarUsuario = mysqli_fetch_object($resultado);
    } else {
        echo "<script>alert('No se encontró ningún usuario con ese documento');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mostrar registro</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/tema.js"></script>
</head>
<body class="d-flex align-items-center" style="min-height: 90vh; padding-top: 30px; padding-bottom: 40px;">

<!-- Botón de tema en la esquina superior derecha -->
<button type="button" class="theme-switch rounded-circle position-absolute top-0 end-0 m-3" id="themeSwitch" aria-label="Cambiar tema" style="width: 40px; height: 40px; padding: 0; border-radius: 50%; z-index: 1050;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </svg>
  </button>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- Logo -->
        <div class="text-center mb-4">
          <a class="navbar-brand" href="../vista/registro.php">
            <img src="../iconos/logo.png" alt="Logo" width="150" height="150">
          </a>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="card shadow-lg p-4">
          <h4 class="text-center mb-5">Mostrar Registro</h4>

          <form>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="documento" class="form-label">Número de documento</label>
                <input type="text" class="form-control" id="documento" name="documento" maxlength="10"
                value="<?php echo isset($listarUsuario) ? $listarUsuario->documento : ''; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nombre1" class="form-label">Primer nombre</label>
                <input type="text" class="form-control" id="nombre1" name="nombre1" maxlength="20" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->nombre1 : ''; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="nombre2" class="form-label">Segundo nombre</label>
                <input type="text" class="form-control" id="nombre2" name="nombre2" maxlength="20" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->nombre2 : ''; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido1" class="form-label">Primer apellido</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1" maxlength="20" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->apellido1 : ''; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2" maxlength="20" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->apellido2 : ''; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="50" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->direccion : ''; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->telefono : ''; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" id="departamento" name="departamento" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->departamento : ''; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="municipio" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="municipio" name="municipio" readonly
                value="<?php echo isset($listarUsuario) ? $listarUsuario->municipio : ''; ?>">
              </div>
            </div>

            <div class="mb-5">
              <label for="perfil" class="form-label">Perfil</label>
              <input type="text" class="form-control" id="perfil" name="perfil" readonly
              value="<?php echo isset($listarUsuario) ? $listarUsuario->perfil : ''; ?>">
            </div>

            <div class="col-md-6 mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="correo" name="correo" maxlength="50" readonly
              value="<?php echo isset($listarUsuario) ? $listarUsuario->correo : ''; ?>">
            </div>

            <div class="d-grid">
              <a href="../vista/registro.php" class="btn btn-dark btn-md">Volver al registro</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
