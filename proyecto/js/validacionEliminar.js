function validacionEliminar() { // antes decía validacionaActualizar
    const form = document.getElementById("formEliminar");
    form.action = "../modelo/modelo.php?opcion=3";
    form.submit();
  }
  