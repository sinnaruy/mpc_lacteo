<?php
include "../conexion/conexion.php";

// Activar reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Obtener todos los usuarios
$sql = "SELECT documento, clave FROM usuario WHERE estado = 'A'";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error al obtener usuarios: " . mysqli_error($conexion));
}

// Actualizar cada contraseña
while ($usuario = mysqli_fetch_assoc($resultado)) {
    // Encriptar la contraseña actual
    $clave_encriptada = password_hash($usuario['clave'], PASSWORD_DEFAULT);
    
    // Actualizar en la base de datos
    $sql_update = "UPDATE usuario SET clave = '$clave_encriptada' WHERE documento = '{$usuario['documento']}'";
    if (!mysqli_query($conexion, $sql_update)) {
        echo "Error al actualizar usuario {$usuario['documento']}: " . mysqli_error($conexion) . "<br>";
    } else {
        echo "Usuario {$usuario['documento']} actualizado correctamente<br>";
    }
}

echo "Proceso completado";
?> 