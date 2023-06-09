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
    $contrasena = isset($_POST['contrasena']) ? mysqli_real_escape_string($db, $_POST['contrasena']) : false;

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

    // Valida si esta vacio la contraseña
    if (!empty($contrasena)) {
        $contrasena_valido = true;
    } else {
        $contrasena_valido = false;
        $errores['contrasena'] = "La Contraseña no es valido";
    }

    $guardar_usuario = false;
    // valida si hay errores
    if (count($errores) == 0) {
        $guardar_usuario = true;
        //password segura
        $contrasena_segura = password_hash($contrasena, PASSWORD_BCRYPT, ['cost' => 4]);
        //Insertar ususario en la tabla de usuarios
        $sql = "INSERT INTO usuarios VALUES (NULL,'$nombre','$apellido','$email','$contrasena_segura',CURDATE())";
        $guardar = mysqli_query($db, $sql);
        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha realizado con exito!!";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario! : " . mysqli_error($db);
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: ../index.php');
