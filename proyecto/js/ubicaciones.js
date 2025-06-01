// Asegúrate de que este código se ejecute después de que el DOM esté cargado
document.addEventListener("DOMContentLoaded", function () {
    const departamentoSelect = document.getElementById("departamento");
    const municipioSelect = document.getElementById("municipio");
  
    let departamentosData = [];
  
    // Cargar los datos desde el archivo JSON
    fetch("/proyecto/data/colombia.min.json")
      .then(response => response.json())
      .then(data => {
        departamentosData = data;
  
        // Llenar el select de departamentos
        data.forEach(dep => {
          const option = document.createElement("option");
          option.value = dep.departamento;
          option.textContent = dep.departamento;
          departamentoSelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error("Error al cargar los datos:", error);
      });
  
    // Evento al cambiar el departamento
    departamentoSelect.addEventListener("change", function () {
      const departamentoSeleccionado = this.value;
  
      // Buscar el departamento seleccionado en los datos
      const departamento = departamentosData.find(dep => dep.departamento === departamentoSeleccionado);
  
      // Limpiar el select de municipios
      municipioSelect.innerHTML = "<option selected>Seleccione un municipio</option>";
      municipioSelect.disabled = true;
  
      if (departamento && departamento.ciudades.length > 0) {
        // Llenar el select de municipios
        departamento.ciudades.forEach(municipio => {
          const option = document.createElement("option");
          option.value = municipio;
          option.textContent = municipio;
          municipioSelect.appendChild(option);
        });
        municipioSelect.disabled = false;
      }
    });
  });
  