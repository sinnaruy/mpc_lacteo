function validacionCrear() {
    const clave = document.getElementById("clave").value;
    const confirmar = document.getElementById("confirmarClave").value;
  
    if (clave !== confirmar) {
      alert("Las contraseñas no coinciden.");
      return false; // Evita el envío del formulario
    }
  
    return true; // Permite el envío
  }
  