let tiempoInactividad = 15 * 60 * 1000; // 15 minutos
let temporizador;

function resetearTemporizador() {
  clearTimeout(temporizador);
  temporizador = setTimeout(() => {
    alert("Sesión cerrada por inactividad.");
    window.location.href = "../modelo/logout.php";
  }, tiempoInactividad);
}

// Escuchar cualquier actividad del usuario
document.addEventListener("mousemove", resetearTemporizador);
document.addEventListener("keydown", resetearTemporizador);
document.addEventListener("click", resetearTemporizador);

// Iniciar el temporizador al cargar
resetearTemporizador();
