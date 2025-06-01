document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");
  const errorDiv = document.getElementById("error");
  const correoInput = document.getElementById("correo");
  const claveInput = document.getElementById("clave");
  const submitButton = loginForm.querySelector("button[type='submit']");
  const bloqueoKey = "bloqueoInicioSesion";
  let intentos = 3;
  const tiempoBloqueo = 5 * 60 * 1000; // 5 minutos en milisegundos

  // Verificar si hay bloqueo
  const bloqueo = localStorage.getItem(bloqueoKey);
  if (bloqueo && Date.now() - parseInt(bloqueo) < tiempoBloqueo) {
    bloquearFormulario();
  }

  // Modal Usuario Desactivado
  const modalUsuarioDesactivado = `
    <div class="modal fade" id="modalUsuarioDesactivado" tabindex="-1" aria-labelledby="modalUsuarioDesactivadoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="modalUsuarioDesactivadoLabel">Usuario desactivado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            Tu cuenta ha sido desactivada. Por favor, contacta al administrador del sistema para reactivar tu cuenta.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal" onclick="window.location.reload()">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
  `;

  // Modal Inicio de Sesión Exitoso
  const modalInicioExitoso = `
    <div class="modal fade" id="modalInicioExitoso" tabindex="-1" aria-labelledby="modalInicioExitosoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalInicioExitosoLabel">Inicio de sesión exitoso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            ¡Bienvenido! Has iniciado sesión correctamente.
          </div>
          <div class="modal-footer">
            <a href="../vista/principal.php" class="btn btn-dark">Continuar</a>
          </div>
        </div>
      </div>
    </div>
  `;

  // Agregar los modales al body
  document.body.insertAdjacentHTML('beforeend', modalUsuarioDesactivado);
  document.body.insertAdjacentHTML('beforeend', modalInicioExitoso);

  // Agregar evento para reiniciar la página cuando se cierre el modal
  document.addEventListener('DOMContentLoaded', function() {
    const modalDesactivado = document.getElementById('modalUsuarioDesactivado');
    if (modalDesactivado) {
      modalDesactivado.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
      });
    }
  });

  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    errorDiv.textContent = ''; // Limpiar mensajes de error anteriores

    const correo = correoInput.value.trim();
    const clave = claveInput.value.trim();

    // Validación básica
    if (!correo || !clave) {
      errorDiv.textContent = "Por favor, completa todos los campos.";
      return;
    }

    // Validación de formato de correo
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo)) {
      errorDiv.textContent = "Por favor, ingresa un correo electrónico válido.";
      return;
    }

    try {
      submitButton.disabled = true; // Deshabilitar el botón durante la petición
      submitButton.textContent = "Iniciando sesión...";

      const response = await fetch("../modelo/validarInicioSesion.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `correo=${encodeURIComponent(correo)}&clave=${encodeURIComponent(clave)}`
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      console.log('Respuesta del servidor:', data); // Para depuración

      if (data.error) {
        throw new Error(data.error);
      }

      if (data.existe) {
        localStorage.removeItem(bloqueoKey); // Si entra bien, eliminamos bloqueo previo
        if (data.desactivado) {
          const modal = new bootstrap.Modal(document.getElementById('modalUsuarioDesactivado'));
          modal.show();
        } else {
          const modal = new bootstrap.Modal(document.getElementById('modalInicioExitoso'));
          modal.show();
        }
      } else {
        intentos--;
        // Mostrar mensaje de error más específico
        if (data.debug === 'Usuario no encontrado') {
          errorDiv.textContent = `El correo electrónico no está registrado. Te quedan ${intentos} intento(s).`;
        } else if (data.debug === 'Contraseña incorrecta') {
          errorDiv.textContent = `La contraseña es incorrecta. Te quedan ${intentos} intento(s).`;
        } else {
          errorDiv.textContent = `Correo o contraseña incorrectos. Te quedan ${intentos} intento(s).`;
        }
        claveInput.value = '';
        claveInput.focus();

        if (intentos === 0) {
          bloquearFormulario();
          localStorage.setItem(bloqueoKey, Date.now().toString());
        }
      }
    } catch (error) {
      console.error('Error:', error);
      errorDiv.textContent = "Error al intentar iniciar sesión. Por favor, intenta nuevamente.";
    } finally {
      submitButton.disabled = false;
      submitButton.textContent = "Entrar";
    }
  });

  function bloquearFormulario() {
    errorDiv.textContent = "Has superado el número máximo de intentos. Intenta nuevamente en 5 minutos.";
    correoInput.disabled = true;
    claveInput.disabled = true;
    submitButton.disabled = true;
  }
});
