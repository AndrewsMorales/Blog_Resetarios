<?php
if (isset($_POST)) {
  // Conexión a la base de datos
  require_once '../includes/conexion.php';

  // Iniciar sesión
  if (!isset($_SESSION)) {
    session_start();
  }
  // Validacion si existen los datos traidos por post
  $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
  $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
  $categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($db, $_POST['categoria']) : false;
  $usuario = $_SESSION['usuario']['id'];
  $categoria = intval($categoria);
  // Array de errores
  $errores = array();

  // Validacion de datos
  // Valida si esta vacio y es numero y si tiene algun numero en el descripcion
  if (!empty($titulo)) {
    $titulo_valido = true;
  } else {
    $titulo_valido = false;
    $errores['titulo'] = "El titulo no es valido";
  }
  if (!empty($descripcion)) {
    $descripcion_valido = true;
  } else {
    $descripcion_valido = false;
    $errores['descripcion'] = "El descripcion no es valido";
  }

  if (!empty($categoria) && is_numeric($categoria)) {
    $categoria_valido = true;
  } else {
    $categoria_valido = false;
    $errores['categoria'] = "El categoria no es valido";
  }

  // valida si hay errores
  if (count($errores) == 0) {
    if (isset($_GET['editar'])) {
      $entrada_id = $_GET['editar'];
      $usuario_id = $_SESSION['usuario']['id'];
      $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id='$categoria' " .
        "WHERE id = $entrada_id AND usuario_id = $usuario_id";
    } else {
      //Insertar ususario en la tabla de usuarios
      $sql = "INSERT INTO entradas VALUES (NULL,$usuario,'$categoria','$titulo','$descripcion',CURDATE())";
    }
    $guardar = mysqli_query($db, $sql);
    if ($guardar) {
      $_SESSION['completado'] = "El registro se ha realizado con exito!!";
      header('Location: ../index.php');
    } else {
      $_SESSION['errores-entradas']['general'] = "Fallo al guardar la entrada    ! : " . mysqli_error($db);
    }
  } else {
    $_SESSION['errores-entradas'] = $errores;
    if (isset($_GET['editar'])) {
      header("Location: ../editar-entrada.php?id=" . $_GET['editar']);
    } else {
      header('Location: ../crear-entradas.php');
    }
  }
}
