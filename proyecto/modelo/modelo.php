<?php  
    //se usa para llamar archivos php
    //variables de entorno $_POST, $_GET, $_SERVER, $_FILE, $_REQUEST
    include $_SERVER["DOCUMENT_ROOT"].  "/proyecto/control/control.php";
    switch($_REQUEST["opcion"]){

        case 1:
            $tipo_documento = $_POST["tipo_documento"];
            $documento = $_POST["documento"];
            $nombre1 = $_POST["nombre1"]; 
            $nombre2 = $_POST["nombre2"]; 
            $apellido1 = $_POST["apellido1"]; 
            $apellido2 = $_POST["apellido2"]; 
            $telefono = $_POST["telefono"]; 
            $direccion = $_POST["direccion"]; 
            $municipio = $_POST["municipio"];
            $departamento = $_POST["departamento"];
            $perfil = $_POST["perfil"];
            $correo = $_POST["correo"];
            $clave = $_POST["clave"];

            Registro:: insertar($tipo_documento, $documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $direccion, $municipio, $departamento,
            $perfil, $correo, $clave);
            break;

        case 2: 
            $tipo_documento = $_POST["tipo_documento"];
            $documento = $_POST["documento"];
            $nombre1 = $_POST["nombre1"]; 
            $nombre2 = $_POST["nombre2"]; 
            $apellido1 = $_POST["apellido1"]; 
            $apellido2 = $_POST["apellido2"]; 
            $telefono = $_POST["telefono"]; 
            $direccion = $_POST["direccion"]; 
            $municipio = $_POST["municipio"];
            $departamento = $_POST["departamento"];
            $perfil = $_POST["perfil"];
            $correo = $_POST["correo"];
            $clave = $_POST["clave"];

            Registro :: modificar($tipo_documento, $documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $direccion, $municipio, $departamento,
            $perfil, $correo, $clave);
            break;

        case 3: //eliminar
            $documento = $_REQUEST["documento"];
            Registro :: eliminar($documento);
            break;

        case 4: //reactivar
            header('Content-Type: application/json');
            $documento = $_REQUEST["documento"];
            include "../conexion/conexion.php";
            $sentenciaSQL = mysqli_query($conexion, "update usuario set estado = 'A' where documento = '$documento'");
            $totalFilas = mysqli_affected_rows($conexion);
            if($totalFilas > 0){
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            break;

        
    }
?>