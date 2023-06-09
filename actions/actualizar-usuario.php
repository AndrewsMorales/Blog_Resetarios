<?php

if (isset($_POST)) {
    // Conexión a la base de datos
    require_once '../includes/conexion.php';

    // Iniciar sesión
    if (!isset($_SESSION)) {
        session_start();
    }

    // Validacion si existen los datos traidos por post
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

    // Array de errores
    $errores = array();

    // Validacion de datos
    // Valida si esta vacio y es numero y si tiene algun numero en el nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_valido = true;
    } else {
        $nombre_valido = false;
        $errores['nombre'] = "El nombre no es valido";
    }

    // Valida si esta vacio y es numero y si tiene algun numero en el apellido
    if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
        $apellido_valido = true;
    } else {
        $apellido_valido = false;
        $errores['apellido'] = "El apellido no es valido";
    }

    // Valida si esta vacio y es un Email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valido = true;
    } else {
        $email_valido = false;
        $errores['email'] = "El email no es valido";
    }


    $guardar_usuario = false;
    // valida si hay errores
    if (count($errores) == 0) {
        $guardar_usuario = true;
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $issetEmail = mysqli_query($db, $sql);
        $issetUser = mysqli_fetch_assoc($issetEmail);
        //Insertar ususario en la tabla de usuarios
        $usuario = $_SESSION['usuario']['id'];
        if ($issetUser['id'] == $usuario || empty($issetUser)) {
            $sqlUsuario = "UPDATE usuarios SET 
                nombre = '$nombre',
                apellidos = '$apellido',
                email = '$email'
              WHERE id = $usuario
        ";
            $guardar = mysqli_query($db, $sql);
            if ($guardar) {
                $_SESSION['completado'] = "Tus datos se han actualizado con exito!!";
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar el usuario! : " . mysqli_error($db);
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe! : " . mysqli_error($db);
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: ../mis-datos.php');
