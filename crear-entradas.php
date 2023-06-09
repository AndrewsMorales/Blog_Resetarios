<!-- Redireccion -->
<?php require_once 'includes/redireccion.php'; ?>
<!-- Cabecera -->
<?php require_once 'includes/header.php'; ?>
<!-- Siderbar -->
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
  <h1>Crear Entradas</h1>
  <p>
    Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
  </p>
  <br>
  <form action="actions/guardar-entrada.php" method="POST">
    <label>Titulo:</label>
    <input type="text" name="titulo">
    <?php echo isset($_SESSION['errores-entradas']) ? mostrarError($_SESSION['errores-entradas'], 'titulo') : ''; ?>
    <label>Descripcion:</label>
    <textarea rows="4" cols="99" name="descripcion"></textarea>
    <?php echo isset($_SESSION['errores-entradas']) ? mostrarError($_SESSION['errores-entradas'], 'descripcion') : ''; ?>
    <label>Categoria:</label>
    <select name="categoria">
      <?php
      $categorias = conseguirCategorias($db);
      if (!empty($categorias)) :
        while ($categoria = mysqli_fetch_assoc($categorias)) :
      ?>
          <option value="<?= $categoria['id'] ?>">
            <?= $categoria['nombre'] ?>
          </option>
      <?php
        endwhile;
      endif;

      ?>
    </select>
    <input type="submit" value="Guardar">
  </form>
  <?php borrarErrores(); ?>
</div>