<?php
session_start();
header("Content-Type: application/json");
include "../conexion/conexion.php";

// Activar reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Log para depuración
    error_log("=== INICIO DE VALIDACIÓN DE SESIÓN ===");
    
    // Verificar que los datos POST lleguen correctamente
    error_log("POST recibido: " . print_r($_POST, true));
    
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    
    error_log("Correo después de escape: " . $correo);
    error_log("Clave recibida (longitud): " . strlen($clave));

    // Primero verificar si el correo existe
    $sql_check = "SELECT COUNT(*) as total FROM usuario WHERE correo = '$correo'";
    $result_check = mysqli_query($conexion, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    error_log("Total de usuarios con este correo: " . $row_check['total']);

    // Buscar el usuario por correo sin filtrar por estado
    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    error_log("SQL Query: " . $sql);
    
    $resultado = mysqli_query($conexion, $sql);
    
    if (!$resultado) {
        error_log("Error en la consulta: " . mysqli_error($conexion));
        echo json_encode(['error' => 'Error en la consulta: ' . mysqli_error($conexion)]);
        exit;
    }

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        error_log("Usuario encontrado:");
        error_log("Estado: " . $usuario['estado']);
        error_log("Clave en BD (hash): " . $usuario['clave']);
        
        // Verificar la contraseña
        $verificacion = password_verify($clave, $usuario['clave']);
        error_log("Resultado de verificación de contraseña: " . ($verificacion ? "true" : "false"));
        
        if ($verificacion) {
            error_log("Contraseña verificada correctamente");
            
            // Si la contraseña es correcta, verificar el estado
            if ($usuario['estado'] === 'A') {
                // Usuario activo
                $_SESSION['usuario'] = $usuario;
                $_SESSION['documento'] = $usuario['documento'];
                $_SESSION['perfil'] = $usuario['perfil'];
                $_SESSION['nombre1'] = $usuario['nombre1'];
                
                error_log("Sesión iniciada para usuario: " . $usuario['correo']);
                
                echo json_encode([
                    'existe' => true,
                    'desactivado' => false,
                    'debug' => [
                        "usuario" => $usuario['correo'],
                        "documento" => $usuario['documento'],
                        "perfil" => $usuario['perfil'],
                        "nombre" => $usuario['nombre1']
                    ]
                ]);
            } else {
                // Usuario desactivado
                error_log("Usuario desactivado intentando iniciar sesión");
                echo json_encode([
                    'existe' => true,
                    'desactivado' => true
                ]);
            }
        } else {
            // Contraseña incorrecta
            error_log("Contraseña incorrecta para usuario: " . $correo);
            echo json_encode([
                'existe' => false,
                'debug' => 'Contraseña incorrecta'
            ]);
        }
    } else {
        // Usuario no existe
        error_log("Usuario no encontrado: " . $correo);
        echo json_encode([
            'existe' => false,
            'debug' => 'Usuario no encontrado'
        ]);
    }
    error_log("=== FIN DE VALIDACIÓN DE SESIÓN ===");
} else {
    error_log("Método no permitido: " . $_SERVER["REQUEST_METHOD"]);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
