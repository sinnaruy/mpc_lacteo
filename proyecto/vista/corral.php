<?php
session_start();
include_once "../conexion/conexion.php";

// Tiempo máximo de inactividad en segundos (ej: 900 = 15 minutos)
$tiempo_inactivo = 900;

if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];
    if ($tiempo_transcurrido > $tiempo_inactivo) {
        session_unset();
        session_destroy();
        header("Location: ../vista/inicio.php?expirado=1"); // redirigir con mensaje
        exit();
    }
}
$_SESSION['ultimo_acceso'] = time();

// --- FILTROS ---
$filtroHato = isset($_GET['filtroHato']) ? $_GET['filtroHato'] : '';
$filtroMetodo = isset($_GET['filtroMetodo']) ? $_GET['filtroMetodo'] : '';
$filtroMaterial = isset($_GET['filtroMaterial']) ? $_GET['filtroMaterial'] : '';
$tamanoMin = isset($_GET['tamanoMin']) ? floatval($_GET['tamanoMin']) : 0;

// --- CONSULTA FILTRADA ---
$where = [];
if ($filtroHato !== '') {
    $where[] = "c.hato_id = '" . mysqli_real_escape_string($conexion, $filtroHato) . "'";
}
if ($filtroMetodo !== '') {
    $where[] = "c.limpieza_id = '" . mysqli_real_escape_string($conexion, $filtroMetodo) . "'";
}
if ($filtroMaterial !== '') {
    $where[] = "c.tipo_material = '" . mysqli_real_escape_string($conexion, $filtroMaterial) . "'";
}
if ($tamanoMin > 0) {
    $where[] = "c.tamaño >= $tamanoMin";
}
$whereSQL = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "SELECT 
            c.id_corral, 
            c.tamaño, 
            c.tipo_material, 
            h.nombre_hato, 
            h.produccion_diaria, 
            l.metodo, 
            l.frecuencia
        FROM corral c
        JOIN hato h ON c.hato_id = h.id_hato
        JOIN limpieza l ON c.limpieza_id = l.id_limpieza
        $whereSQL";
$resultado = mysqli_query($conexion, $sql);

// Para los filtros:
$hatos = mysqli_query($conexion, "SELECT id_hato, nombre_hato FROM hato");
$metodos = mysqli_query($conexion, "SELECT id_limpieza, metodo FROM limpieza");
$materiales = mysqli_query($conexion, "SELECT DISTINCT tipo_material FROM corral");
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard de Corrales</title>
  <link rel="icon" type="image/png" href="../iconos/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/tema.js"></script>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="../vista/principal.php">
        <img src="../iconos/logo.png" alt="MPC LACTEO" width="80px" height="80px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/principal.php">Página principal</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestión
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../vista/hato.php">Hato</a></li>
              <li><a class="dropdown-item" href="../vista/limpieza.php">Limpieza</a></li>
              <li><a class="dropdown-item" href="../vista/tipo_suelo.php">Tipo de suelo</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transaccionales
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Corral</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/contacto.php">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../vista/perfil.php">Perfil</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-dark" type="submit">Buscar</button>
      </form>
      <a href="../vista/inicio.php"><button type="submit" class="btn btn-dark ms-5">Cerrar sesión</button></a>
    </div>
    <button type="button" class="theme-switch rounded-circle ms-3" id="themeSwitch" aria-label="Cambiar tema" style="width: 40px; height: 40px; padding: 0; border-radius: 50%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </svg>
      </button>
  </nav>

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Información de corrales</h2>
      <button class="btn btn-dark">Exportar a Excel</button>
    </div>
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm p-3">
          <h5 class="mb-1">Total de Corrales</h5>
          <h2 class="fw-bold" id="totalCorrales">5</h2>
          <span class="text-muted">En 5 Hatos</span>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm p-3">
          <h5 class="mb-1">Tamaño Promedio</h5>
          <h2 class="fw-bold" id="tamanoPromedio">85.6 m<sup>2</sup></h2>
          <span class="text-muted">Rango: 50.2 - 120.4 m<sup>2</sup></span>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm p-3">
          <h5 class="mb-1">Frecuencia de Limpieza</h5>
          <h2 class="fw-bold" id="frecuenciaDiaria">Diaria: 58%</h2>
          <span class="text-muted">Semanal: 33%, Quincenal: 9%</span>
        </div>
      </div>
    </div>
    <form class="card p-4 mb-4 shadow-sm" method="get">
      <div class="row g-3 align-items-end">
        <div class="col-md-3">
          <label for="filtroHato" class="form-label">Hato</label>
          <select class="form-select" id="filtroHato" name="filtroHato">
            <option value="">Todos los hatos</option>
            <?php while ($hato = mysqli_fetch_assoc($hatos)) {
              $selected = ($filtroHato == $hato['id_hato']) ? 'selected' : '';
              echo "<option value='{$hato['id_hato']}' $selected>{$hato['nombre_hato']}</option>";
            } ?>
          </select>
        </div>
        <div class="col-md-3">
          <label for="filtroMetodo" class="form-label">Método de Limpieza</label>
          <select class="form-select" id="filtroMetodo" name="filtroMetodo">
            <option value="">Todos los métodos</option>
            <?php while ($metodo = mysqli_fetch_assoc($metodos)) {
              $selected = ($filtroMetodo == $metodo['id_limpieza']) ? 'selected' : '';
              echo "<option value='{$metodo['id_limpieza']}' $selected>{$metodo['metodo']}</option>";
            } ?>
          </select>
        </div>
        <div class="col-md-3">
          <label for="filtroMaterial" class="form-label">Material</label>
          <select class="form-select" id="filtroMaterial" name="filtroMaterial">
            <option value="">Todos los materiales</option>
            <?php while ($material = mysqli_fetch_assoc($materiales)) {
              $selected = ($filtroMaterial == $material['tipo_material']) ? 'selected' : '';
              echo "<option value='{$material['tipo_material']}' $selected>{$material['tipo_material']}</option>";
            } ?>
          </select>
        </div>
        <div class="col-md-2">
          <label for="tamanoMin" class="form-label">Tamaño Mínimo (m<sup>2</sup>)</label>
          <input type="number" class="form-control" id="tamanoMin" name="tamanoMin" min="0" value="<?php echo htmlspecialchars($tamanoMin); ?>">
        </div>
        <div class="col-md-1 d-grid">
          <button type="submit" class="btn btn-dark">Aplicar Filtros</button>
        </div>
      </div>
    </form>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID Corral</th>
            <th>Tamaño (m<sup>2</sup>)</th>
            <th>Material</th>
            <th>Hato</th>
            <th>Producción Diaria</th>
            <th>Método de Limpieza</th>
            <th>Frecuencia</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($fila = mysqli_fetch_assoc($resultado)) {
              echo "<tr>
                      <td>{$fila['id_corral']}</td>
                      <td>{$fila['tamaño']}</td>
                      <td>{$fila['tipo_material']}</td>
                      <td>{$fila['nombre_hato']}</td>
                      <td>{$fila['produccion_diaria']} L</td>
                      <td>{$fila['metodo']}</td>
                      <td>{$fila['frecuencia']}</td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
      <p class="mb-0">© 2025 MPC LÁCTEO. Todos los derechos reservados.</p>
      <p class="mb-0">Contacto: contacto@mpclacteo.com</p>
    </div>
  </footer>
  
</body>
</html>
