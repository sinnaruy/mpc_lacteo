<?php
include "../conexion/conexion.php";

// Si viene el parámetro documento por GET, responder con JSON y terminar
if (isset($_GET['documento']) && !isset($_GET['opcion'])) {
    header('Content-Type: application/json');
    $documento = $_GET['documento'];
    $sql = "SELECT * FROM usuario WHERE documento = '$documento'";
    $resultado = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        echo json_encode([
            'existe' => true,
            'estado' => $usuario['estado']
        ]);
    } else {
        echo json_encode(['existe' => false]);
    }
    exit;
}

$mostrarModalNoExiste = false;
$usuario = null;

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    $sql = "SELECT * FROM usuario WHERE documento = '$documento' AND estado = 'A'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_object($resultado);
    } else {
        $mostrarModalNoExiste = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="../js/ubicaciones.js"></script>
  <script src="../js/validacionRegistro.js"></script>
  <script src="../js/tema.js"></script>
</head>
<body class="d-flex align-items-center" style="min-height: 90vh; padding-top: 30px; padding-bottom: 40px;">

  <!-- Flechita para volver a inicio -->
  <a href="../vista/iniciarSesion.php" class="position-absolute top-0 start-0 m-3" style="z-index: 1050; text-decoration: none; color:rgb(0, 0, 0);">
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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- Logo -->
        <div class="text-center mb-4">
          <a class="navbar-brand" href="../vista/inicio.php">
            <img src="../iconos/logo.png" alt="Logo" width="150" height="150">
          </a>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="card shadow-lg p-4">
          <h4 class="text-center mb-5">Registro de Usuario</h4>

          <form action="../modelo/modelo.php?opcion=1" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="tipo_documento" class="form-label">Tipo de documento<b class="mandatory">*</b></label>
                <select class="form-select" id="tipo_documento" name="tipo_documento">
                  <option selected disabled>Seleccione una opción</option>
                  <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                  <option value="Cédula de extranjería">Cédula de extranjería</option>
                  <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                  <option value="Pasaporte">Pasaporte</option>
                  <option value="NIT">NIT</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="documento" class="form-label">Número de documento<b class="mandatory">*</b></label>
                <input type="text" class="form-control" id="documento" name="documento" maxlength="10" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nombre1" class="form-label">Primer nombre<b class="mandatory">*</b></label>
                <input type="text" class="form-control" id="nombre1" name="nombre1" maxlength="20" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="nombre2" class="form-label">Segundo nombre</label>
                <input type="text" class="form-control" id="nombre2" name="nombre2" maxlength="20">
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido1" class="form-label">Primer apellido<b class="mandatory">*</b></label>
                <input type="text" class="form-control" id="apellido1" name="apellido1" maxlength="20" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2" maxlength="20">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono<b class="mandatory">*</b></label>
                <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="10" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="direccion" class="form-label">Dirección<b class="mandatory">*</b></label>
                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="50" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="departamento" class="form-label">Departamento<b class="mandatory">*</b></label>
                <select id="departamento" name="departamento" class="form-select" required>
                  <option selected>Seleccione un departamento</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="municipio" class="form-label">Ciudad<b class="mandatory">*</b></label>
                <select id="municipio" name="municipio" class="form-select" disabled>
                  <option selected>Seleccione un municipio</option>
                </select>
              </div>
            </div>

            <div class="mb-5">
              <label for="perfil" class="form-label">Perfil<b class="mandatory">*</b></label>
              <select class="form-select" id="perfil" name="perfil">
                <option selected disabled>Seleccione una opción</option>
                <option value="Ordeñador">Ordeñador</option>
                <option value="Propietario">Propietario</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="correo" class="form-label">Correo electrónico<b class="mandatory">*</b></label>
              <input type="email" class="form-control" id="correo" name="correo" maxlength="50" required>
            </div>

            <div class="col-md-5 mb-3">
              <label for="clave" class="form-label">Contraseña<b class="mandatory">*</b></label>
              <div class="input-group">
                <input type="password" class="form-control" id="clave" name="clave" maxlength="8" required>
                <button type="button" class="toggle-password border-0 bg-transparent p-0 ms-2" data-target="clave" aria-label="Mostrar/Ocultar contraseña">
                  <span class="icon-eye">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                      <circle cx="12" cy="12" r="3"/>
                    </svg>
                  </span>
                  <span class="icon-eye-off d-none">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-6.06M1 1l22 22"/>
                      <path d="M9.53 9.53A3 3 0 0 0 12 15a3 3 0 0 0 2.47-5.47"/>
                    </svg>
                  </span>
                </button>
              </div>
            </div>

            <div class="col-md-5 mb-5">
              <label for="confirmarClave" class="form-label">Confirmar contraseña<b class="mandatory">*</b></label>
              <div class="input-group">
                <input type="password" class="form-control" id="confirmarClave" name="confirmarClave" maxlength="8" required>
                <button type="button" class="toggle-password border-0 bg-transparent p-0 ms-2" data-target="confirmarClave" aria-label="Mostrar/Ocultar contraseña">
                  <span class="icon-eye">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                      <circle cx="12" cy="12" r="3"/>
                    </svg>
                  </span>
                  <span class="icon-eye-off d-none">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-6.06M1 1l22 22"/>
                      <path d="M9.53 9.53A3 3 0 0 0 12 15a3 3 0 0 0 2.47-5.47"/>
                    </svg>
                  </span>
                </button>
              </div>
            </div>

            <div id="mensajeActualizar" class="text-danger d-none mb-3"></div>

            <div class="row">
              <div class="col-md-6 mb-3 d-grid">
                <button type="submit" class="btn btn-dark" onclick="return validarIncompletos(event)">Guardar</button>
              </div>
              <div class="col-md-6 mb-3 d-grid">
                <button type="button" class="btn btn-dark" onclick="abrirModalDocumento('buscar')">Buscar</button>
              </div>
              <div class="col-md-6 mb-3 d-grid">
                <button type="button" class="btn btn-dark" onclick="abrirModalDocumento('actualizar')">Actualizar</button>
              </div>
              <div class="col-md-6 mb-3 d-grid">
                <button type="button" class="btn btn-dark" onclick="abrirModalDocumento('eliminar')">Eliminar</button>
              </div>
              <div class="col-12 d-grid">
                <button type="reset" class="btn btn-dark" value="Limpiar">Limpiar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modales Bootstrap -->
  <!-- Modal Guardar Exitoso -->
  <div class="modal fade" id="modalGuardarExitoso" tabindex="-1" aria-labelledby="modalGuardarExitosoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalGuardarExitosoLabel">Registro exitoso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          El registro fue exitoso.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ingresar Documento (Buscar, Actualizar, Eliminar) -->
  <div class="modal fade" id="modalDocumento" tabindex="-1" aria-labelledby="modalDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDocumentoLabel">Ingresar documento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <label for="inputDocumentoModal" class="form-label">Número de documento:</label>
          <input type="text" class="form-control" id="inputDocumentoModal" maxlength="10">
          <div id="errorDocumentoModal" class="text-danger mt-2 d-none">Por favor ingrese un documento válido.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" id="btnConfirmarDocumento">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Documento No Existe -->
  <div class="modal fade" id="modalNoExiste" tabindex="-1" aria-labelledby="modalNoExisteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalNoExisteLabel">Documento no encontrado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          El documento no existe.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Usuario Desactivado -->
  <div class="modal fade" id="modalUsuarioDesactivado" tabindex="-1" aria-labelledby="modalUsuarioDesactivadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="modalUsuarioDesactivadoLabel">Usuario desactivado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          Este usuario está desactivado. ¿Deseas reactivarlo?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-dark" id="btnReactivarUsuario">Sí, reactivar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Usuario Reactivado -->
  <div class="modal fade" id="modalReactivado" tabindex="-1" aria-labelledby="modalReactivadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalReactivadoLabel">Usuario reactivado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¡El usuario ha sido reactivado exitosamente!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Datos Actualizados -->
  <div class="modal fade" id="modalActualizado" tabindex="-1" aria-labelledby="modalActualizadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizadoLabel">Actualización exitosa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¡Datos actualizados correctamente!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Datos Incompletos -->
  <div class="modal fade" id="modalIncompleto" tabindex="-1" aria-labelledby="modalIncompletoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="modalIncompletoLabel">Datos incompletos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          Datos incompletos, llena el formulario.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de error de duplicado -->
  <div class="modal fade" id="modalDuplicado" tabindex="-1" aria-labelledby="modalDuplicadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalDuplicadoLabel">Error de registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body" id="mensajeDuplicado">
          <!-- Aquí va el mensaje dinámico -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Modal para buscar, actualizar, eliminar
    let accionModal = '';
    let documentoActual = '';
    
    function abrirModalDocumento(accion) {
      accionModal = accion;
      document.getElementById('inputDocumentoModal').value = '';
      document.getElementById('errorDocumentoModal').classList.add('d-none');
      const modal = new bootstrap.Modal(document.getElementById('modalDocumento'));
      modal.show();
    }

    document.getElementById('btnConfirmarDocumento').onclick = function() {
      const documento = document.getElementById('inputDocumentoModal').value.trim();
      if (!documento) {
        document.getElementById('errorDocumentoModal').classList.remove('d-none');
        return;
      }
      documentoActual = documento;
      
      // AJAX para verificar si existe el documento
      fetch('../vista/registro.php?documento=' + encodeURIComponent(documento))
        .then(response => response.json())
        .then(data => {
          if (data.existe) {
            if (data.estado === 'I') {
              // Si el usuario está desactivado, mostrar modal de reactivación
              const modalDesactivado = new bootstrap.Modal(document.getElementById('modalUsuarioDesactivado'));
              modalDesactivado.show();
            } else {
              // Si está activo, proceder con la acción normal
              procederConAccion(documento);
            }
          } else {
            const modalNoExiste = new bootstrap.Modal(document.getElementById('modalNoExiste'));
            modalNoExiste.show();
          }
        })
        .catch(() => {
          const modalNoExiste = new bootstrap.Modal(document.getElementById('modalNoExiste'));
          modalNoExiste.show();
        });
    };

    // Función para proceder con la acción después de verificar el estado
    function procederConAccion(documento) {
      if (accionModal === 'buscar') {
        window.location.href = 'mostrarRegistro.php?documento=' + documento;
      } else if (accionModal === 'actualizar') {
        window.location.href = 'actualizarDatos.php?documento=' + documento;
      } else if (accionModal === 'eliminar') {
        window.location.href = 'eliminarRegistro.php?documento=' + documento;
      }
    }

    // Manejar la reactivación del usuario
    document.getElementById('btnReactivarUsuario').onclick = function() {
      fetch('../modelo/modelo.php?opcion=4&documento=' + encodeURIComponent(documentoActual))
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const modalReactivado = new bootstrap.Modal(document.getElementById('modalReactivado'));
            modalReactivado.show();
            // Cerrar el modal de usuario desactivado
            bootstrap.Modal.getInstance(document.getElementById('modalUsuarioDesactivado')).hide();
            // Después de mostrar el modal de reactivación, proceder con la acción original
            document.getElementById('modalReactivado').addEventListener('hidden.bs.modal', function() {
              procederConAccion(documentoActual);
            }, { once: true });
          }
        });
    };

    // Mostrar/ocultar contraseña principal
    document.querySelectorAll('.toggle-password').forEach(button => {
      button.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        const input = document.getElementById(target);
        const eye = this.querySelector('.icon-eye');
        const eyeOff = this.querySelector('.icon-eye-off');
        if (input.type === 'password') {
          input.type = 'text';
          eye.classList.add('d-none');
          eyeOff.classList.remove('d-none');
        } else {
          input.type = 'password';
          eye.classList.remove('d-none');
          eyeOff.classList.add('d-none');
        }
      });
    });

    // Validación de campos obligatorios para mostrar modal de datos incompletos
    function validarIncompletos(event) {
      const form = event.target.form;
      let incompleto = false;
      // Lista de campos obligatorios
      const campos = [
        'nombre1', 'apellido1', 'documento', 'telefono', 'direccion',
        'departamento', 'municipio', 'perfil', 'correo', 'clave', 'confirmarClave'
      ];
      for (let campo of campos) {
        const el = form.elements[campo];
        if (!el || el.value.trim() === '' || (el.tagName === 'SELECT' && (el.selectedIndex === 0 || el.value === '' || el.value === null))) {
          incompleto = true;
          break;
        }
      }
      if (incompleto) {
        event.preventDefault();
        const modal = new bootstrap.Modal(document.getElementById('modalIncompleto'));
        modal.show();
        return false;
      }
      return true;
    }
  </script>
  <?php if (isset($_GET['actualizado']) && $_GET['actualizado'] == 1): ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      const modal = new bootstrap.Modal(document.getElementById('modalActualizado'));
      modal.show();
    });
  </script>
  <?php endif; ?>
  <?php if (isset($_GET['guardado']) && $_GET['guardado'] == 1): ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      const modal = new bootstrap.Modal(document.getElementById('modalGuardarExitoso'));
      modal.show();
    });
  </script>
  <?php endif; ?>
  <!-- Documentos duplicados -->
  <?php if (isset($_GET['error'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var mensaje = '';
      <?php if ($_GET['error'] == 'documento'): ?>
        mensaje = 'El documento de identidad ya está registrado. Por favor, usa otro.';
      <?php elseif ($_GET['error'] == 'correo'): ?>
        mensaje = 'El correo electrónico ya está registrado. Por favor, usa otro.';
      <?php endif; ?>
      document.getElementById('mensajeDuplicado').textContent = mensaje;
      var modal = new bootstrap.Modal(document.getElementById('modalDuplicado'));
      modal.show();
      // Al cerrar el modal, recarga la página sin el parámetro error
      document.getElementById('modalDuplicado').addEventListener('hidden.bs.modal', function () {
        window.location.href = 'registro.php';
      }, { once: true });
    });
  </script>
  <?php endif; ?>
</body>
</html>