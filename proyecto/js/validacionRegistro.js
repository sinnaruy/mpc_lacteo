document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  const inputs = {
    nombre1: { regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{1,20}$/, message: "Solo letras. Máximo 20 caracteres." },
    nombre2: { regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{0,20}$/, message: "Solo letras. Máximo 20 caracteres." },
    apellido1: { regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{1,20}$/, message: "Solo letras. Máximo 20 caracteres." },
    apellido2: { regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{0,20}$/, message: "Solo letras. Máximo 20 caracteres." },
    documento: { regex: /^\d{1,10}$/, message: "Solo números. Máximo 10 dígitos." },
    telefono: { regex: /^\d{10}$/, message: "Debe tener exactamente 10 números." },
    direccion: { regex: /^.{1,50}$/, message: "Máximo 50 caracteres." },
    correo: { regex: /^[\w\.-]+@[\w\.-]+\.\w{2,4}$/, message: "Correo inválido o demasiado largo (máx. 50)." }
  };

  const validateInput = (input, config) => {
    const value = input.value.trim();
    if (!config.regex.test(value)) {
      markInvalid(input, config.message);
      return false;
    } else {
      unmarkInvalid(input);
      return true;
    }
  };

  const markInvalid = (input, message) => {
    input.classList.add("is-invalid");
    const parent = input.parentNode;
    parent.querySelectorAll(".invalid-feedback").forEach(e => e.remove());

    const error = document.createElement("div");
    error.className = "invalid-feedback";
    error.textContent = message;
    parent.appendChild(error);
  };

  const unmarkInvalid = (input) => {
    input.classList.remove("is-invalid");
    const parent = input.parentNode;
    parent.querySelectorAll(".invalid-feedback").forEach(e => e.remove());
  };

  const validarClave = () => {
    const clave = claveInput.value.trim();
    const confirmar = confirmarInput.value.trim();

    const claveValida = /^.{8}$/.test(clave) && /[A-Za-z]/.test(clave) && /\d/.test(clave);
    const confirmarValido = /^.{8}$/.test(confirmar);

    if (!claveValida) {
      markInvalid(claveInput, "Debe tener 8 caracteres, incluir letras y números.");
    } else {
      unmarkInvalid(claveInput);
    }

    if (clave !== confirmar || !confirmarValido) {
      markInvalid(confirmarInput, "Las contraseñas no coinciden o no tienen 8 caracteres.");
    } else {
      unmarkInvalid(confirmarInput);
    }

    return claveValida && clave === confirmar;
  };

  form.addEventListener("submit", function (e) {
    let valid = true;

    for (const id in inputs) {
      const input = document.getElementById(id);
      const config = inputs[id];

      if (id === "correo" && input.value.length > 50) {
        markInvalid(input, "Correo demasiado largo (máx. 50).");
        valid = false;
      } else if (!validateInput(input, config)) {
        valid = false;
      }
    }

    if (!validarClave()) valid = false;

    if (!valid) e.preventDefault();
  });

  // --- Validación robusta solo para contraseñas ---
  const claveInput = document.getElementById("clave");
  const confirmarInput = document.getElementById("confirmarClave");

  function showPasswordError(input, message) {
    // Elimina todos los mensajes de error hermanos del input
    let next = input.nextElementSibling;
    while (next && next.classList.contains("invalid-feedback")) {
      let toRemove = next;
      next = next.nextElementSibling;
      toRemove.remove();
    }
    // Crea y agrega el nuevo mensaje
    const error = document.createElement("div");
    error.className = "invalid-feedback";
    error.textContent = message;
    input.after(error);
    input.classList.add("is-invalid");
  }

  function hidePasswordError(input) {
    let next = input.nextElementSibling;
    while (next && next.classList.contains("invalid-feedback")) {
      let toRemove = next;
      next = next.nextElementSibling;
      toRemove.remove();
    }
    input.classList.remove("is-invalid");
  }

  function validarSoloClave() {
    let valido = true;
    const clave = claveInput.value.trim();
    const confirmar = confirmarInput.value.trim();

    if (!/^.{8}$/.test(clave) || !/[A-Za-z]/.test(clave) || !/\d/.test(clave)) {
      showPasswordError(claveInput, "Debe tener 8 caracteres, incluir letras y números.");
      valido = false;
    } else {
      hidePasswordError(claveInput);
    }

    if (clave !== confirmar || confirmar.length !== 8) {
      showPasswordError(confirmarInput, "Las contraseñas no coinciden o no tienen 8 caracteres.");
      valido = false;
    } else {
      hidePasswordError(confirmarInput);
    }

    return valido;
  }

  // Solo mostrar error en blur o submit
  claveInput.addEventListener("blur", validarSoloClave);
  confirmarInput.addEventListener("blur", validarSoloClave);

  // Ocultar error mientras escribe
  claveInput.addEventListener("input", function() {
    hidePasswordError(claveInput);
  });
  confirmarInput.addEventListener("input", function() {
    hidePasswordError(confirmarInput);
  });

  // Validar también al enviar el formulario
  form.addEventListener("submit", function(e) {
    if (!validarSoloClave()) e.preventDefault();
  });
});

 