<?php
include "../conexion/conexion.php";

if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    
    // Realizar la búsqueda en la tabla usuario
    $query = "SELECT * FROM usuario 
              WHERE (documento LIKE '%$busqueda%' 
              OR nombre1 LIKE '%$busqueda%' 
              OR apellido1 LIKE '%$busqueda%'
              OR correo LIKE '%$busqueda%')
              AND estado = 'A'";
    
    $resultado = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($resultado) > 0) {
        echo "<div class='container mt-4'>";
        echo "<h2>Resultados de la búsqueda</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped'>";
        echo "<thead><tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
              </tr></thead>";
        echo "<tbody>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['documento']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['nombre1']) . " " . htmlspecialchars($fila['nombre2']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['apellido1']) . " " . htmlspecialchars($fila['apellido2']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody></table>";
        echo "</div>";
        echo "<a href='../vista/inicio.php' class='btn btn-dark mt-3'>Volver al inicio</a>";
        echo "</div>";
    } else {
        echo "<div class='container mt-4'>";
        echo "<div class='alert alert-info'>No se encontraron resultados para tu búsqueda.</div>";
        echo "<a href='../vista/inicio.php' class='btn btn-dark'>Volver al inicio</a>";
        echo "</div>";
    }
} else {
    header("Location: ../vista/inicio.php");
    exit();
}
?> 