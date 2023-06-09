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

    // valida si hay errores
    if (count($errores) == 0) {
        //password segura
        $contrasena_segura = password_hash($contrasena, PASSWORD_BCRYPT, ['cost' => 4]);
        //Insertar ususario en la tabla de usuarios
        $sql = "INSERT INTO categorias VALUES (NULL,'$nombre')";
        $guardar = mysqli_query($db, $sql);
        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha realizado con exito!!";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar la categoria    ! : " . mysqli_error($db);
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: ../index.php');
