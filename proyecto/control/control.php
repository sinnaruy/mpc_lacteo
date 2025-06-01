<?php
    class Registro {
        function __construct($tipo_documento, $documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $direccion, $municipio, $departamento,
        $perfil, $correo, $clave, $confirmarClave){
            $this -> tipo_documento = $tipo_documento;
            $this -> documento = $documento;
            $this -> nombre1 = $nombre1;
            $this -> nombre2 = $nombre2;
            $this -> apellido1 = $apellido1;
            $this -> apellido2 = $apellido2;
            $this -> telefono = $telefono;
            $this -> direccion = $direccion;
            $this -> municipio = $municipio;
            $this -> departamento = $departamento;
            $this -> seleccion = $perfil;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> confirmarClave = $confirmarClave;
        }

        public static function insertar($tipo_documento, $documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $direccion, $municipio, $departamento,
        $perfil, $correo, $clave){
            include "../conexion/conexion.php";
            // Validar documento duplicado
            $sentenciaSQL = mysqli_query($conexion, "select documento from usuario where documento = '$documento' and estado = 'A' ");
            if(mysqli_num_rows($sentenciaSQL) > 0){
                header("Location: ../vista/registro.php?error=documento");
                exit();
            }
            // Validar correo duplicado
            $sentenciaSQL = mysqli_query($conexion, "select correo from usuario where correo = '$correo' and estado = 'A' ");
            if(mysqli_num_rows($sentenciaSQL) > 0){
                header("Location: ../vista/registro.php?error=correo");
                exit();
            }
            
            // Encriptar la contraseña antes de guardarla
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            
            // Si no hay duplicados, insertar
            $sentenciaSQL = mysqli_query($conexion, "insert into usuario(tipo_documento, documento, nombre1, nombre2, apellido1, apellido2, telefono, 
            direccion, municipio, departamento, perfil, correo, clave, estado) values ('$tipo_documento','$documento','$nombre1', '$nombre2', '$apellido1', '$apellido2', '$telefono', 
            '$direccion', '$municipio', '$departamento', '$perfil', '$correo', '$clave_encriptada', 'A')");
            header("Location: ../vista/registro.php?guardado=1");
            exit();
        }

        public static function modificar($tipo_documento, $documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $direccion, $municipio, $departamento,
        $perfil, $correo, $clave){
            include "../conexion/conexion.php";
            
            // Encriptar la nueva contraseña
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            
            $sentenciaSQL = mysqli_query($conexion, "update usuario set documento = '$documento',tipo_documento = '$tipo_documento', nombre1 = 
            '$nombre1', nombre2 = '$nombre2', apellido1 = '$apellido1', apellido2 = '$apellido2', telefono = '$telefono',
            direccion = '$direccion', municipio = '$municipio', departamento = '$departamento', perfil = '$perfil', correo = '$correo',
            clave = '$clave_encriptada' where documento =
            '$documento'");
            $totalFilas = mysqli_affected_rows($conexion);
            if($totalFilas == 0){
                echo "<script> alert('no se modificó el registro');history.back();</script>";
            }
            else{
                echo "<script>window.location.href='../vista/registro.php?actualizado=1';</script>";
            }
        }

        public static function eliminar($documento){
            include "../conexion/conexion.php";
            $sentenciaSQL = mysqli_query($conexion, "update usuario set estado = 'I' where documento = '$documento'");
            //mysqli_affected_rows = indica cuantos registros se afcetaron en una eliminacion o en una modificacion
            $totalFilas = mysqli_affected_rows($conexion);
            if($totalFilas == 0){
                echo "<script> alert('no se eliminó el registro');history.back();</script>";
            }
            else{
                header("Location: ../vista/registro.php");
                exit();
            }   
        }
    }


    class RegistroCorral{
        function __construct($id_corral, $tamaño, $tipo_material, $limpieza_id, $hato_id){
            $this -> id_corral = $id_corral;
            $this -> tamaño = $tamaño;
            $this -> tipo_material = $tipo_material;
            $this -> limpieza_id = $limpieza_id;
            $this -> hato_id = $hato_id;
        }

        public static function insertarCorral($id_corral, $tamaño, $tipo_material, $limpieza_id, $hato_id){
            include "../conexion/conexion.php";
            $sentenciaSQL = mysqli_query($conexion, "select id_corral from corral where id_corral = 
            '$id_corral' and estado = 'A' ");
            $totalFilas = mysqli_num_rows($sentenciaSQL);
            if($totalFilas == 0){
                $sentenciaSQL = mysqli_query($conexion, "insert into corral(id_corral, tamaño, tipo_material, limpieza_id, hato_id, 
                estado) values ('$id_corral', '$tamaño', '$tipo_material', '$limpieza_id', '$hato_id', 'A')");
                echo "<script>window.location.href='../modelo/modelo.php?opcion=5';</script>";
            }
            else{
                  echo "<script>alert('ya existe el registro en la BD');
                history.back();</script>";

            }
        }

    }