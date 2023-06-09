<?php
//iniciar la sesion y la conexion a bd
//Recoger datos del formulario
//Comprobar la contrasena
//Consulta para comprobar las credenciales del usuario
//Utilizar una sesion para guardar los datos del usuario logueado
//si algo falla enviar una sesion con el fallo
//Redirigir al index.php

require_once '../includes/conexion.php';
if (isset($_POST)) {
    // Conexión a la base de datos

    // Iniciar sesión
    if (isset($_SESSION['error_login'])) {
        $_SESSION['error_login'] = "";
    }

    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    //Consulta para comprobar las credenciales del usuario
    $sql  = "SELECT * FROM usuarios WHERE email = '$email'";
    $login =  mysqli_query($db, $sql);
    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        // Comprobar la contraseña
        $verify = password_verify($contrasena, $usuario['password']);

        if ($verify) {
            // Utilizar una sesión para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
        } else {
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    } else {
        // mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
    }
}

// Redirigir al index.php
header('Location: ../index.php');
