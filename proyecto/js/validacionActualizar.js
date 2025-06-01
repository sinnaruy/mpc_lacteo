function validacionActualizar() {
  const form = document.getElementById("formActualizar");
  const clave = document.getElementById("clave").value.trim();
  const confirmarClave = document.getElementById("confirmarClave").value.trim();

  if (clave !== "" || confirmarClave !== "") {
    const esValida = validarClaveActualizacion(clave, confirmarClave);
    if (!esValida) {
      // Limpiar campos si no son válidos
      document.getElementById("clave").value = "";
      document.getElementById("confirmarClave").value = "";
      return; // Detener el envío
    }
  }

  form.action = "../modelo/modelo.php?opcion=2";
  form.submit();
}

function validarClaveActualizacion(clave, confirmarClave) {
  const claveInput = document.getElementById("clave");
  const confirmarInput = document.getElementById("confirmarClave");

  const claveValida = /^.{8}$/.test(clave) && /[A-Za-z]/.test(clave) && /\d/.test(clave);

  if (!claveValida) {
    mostrarError(claveInput, "La contraseña debe tener 8 caracteres, incluir letras y números.");
    return false;
  } else {
    limpiarError(claveInput);
  }

  if (clave !== confirmarClave) {
    mostrarError(confirmarInput, "Las contraseñas no coinciden.");
    return false;
  } else {
    limpiarError(confirmarInput);
  }

  return true;
}

function mostrarError(input, mensaje) {
  input.classList.add("is-invalid");
  let error = input.nextElementSibling;
  if (!error || !error.classList.contains("invalid-feedback")) {
    error = document.createElement("div");
    error.className = "invalid-feedback";
    input.parentNode.appendChild(error);
  }
  error.textContent = mensaje;
}

function limpiarError(input) {
  input.classList.remove("is-invalid");
  const error = input.nextElementSibling;
  if (error && error.classList.contains("invalid-feedback")) {
    error.remove();
  }
}
