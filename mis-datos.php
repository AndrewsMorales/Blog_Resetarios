<!-- Redireccion -->
<?php require_once 'includes/redireccion.php'; ?>
<!-- Cabecera -->
<?php require_once 'includes/header.php'; ?>
<!-- Siderbar -->
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
  <h1>Mis datos</h1>
  <br>
  <?php if (isset($_SESSION['completado'])) : ?>
    <div class="alerta alerta-exito">
      <?= $_SESSION['completado'] ?>
    </div>
  <?php elseif (isset($_SESSION['errores']['general'])) : ?>
    <div class="alerta alerta-error">
      <?= $_SESSION['errores']['general'] ?>
    </div>
  <?php endif; ?>

  <form action="actions/actualizar-usuario.php" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo isset($_SESSION['usuario']['nombre']) ? $_SESSION['usuario']['nombre'] : ''; ?>" autocomplete="off">
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="apellido" value="<?php echo isset($_SESSION['usuario']['apellidos']) ? $_SESSION['usuario']['apellidos'] : ''; ?>" autocomplete="off">
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['usuario']['email']) ? $_SESSION['usuario']['email'] : ''; ?>" autocomplete="off">
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

    <input class="boton" name="submit" type="submit" value="Actualizar">
  </form>
  <?php borrarErrores(); ?>
</div>