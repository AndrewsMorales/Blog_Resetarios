<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
$entrada_editar = conseguirEntrada($db, $_GET['id']);
if (!isset($entrada_editar['id'])) {
  header("Location:index.php");
}
?>
<!-- Cabecera -->
<?php require_once 'includes/header.php'; ?>
<!-- Siderbar -->
<?php require_once 'includes/sidebar.php'; ?>
<!-- Contenido -->
<div id="principal">
  <h1>Editar Entrada</h1>
  <p>
    Edita la entrada que creaste anteriormente.
  </p>
  <br>
  <form action="actions/guardar-entrada.php?editar=<?= $entrada_editar['id'] ?>" method="POST">
    <label>Titulo:</label>
    <input type="text" name="titulo" value="<?= $entrada_editar['titulo'] ?>">
    <?php echo isset($_SESSION['errores-entradas']) ? mostrarError($_SESSION['errores-entradas'], 'titulo') : ''; ?>
    <label>Descripcion:</label>
    <textarea rows="4" cols="99" name="descripcion"><?= $entrada_editar['descripcion'] ?></textarea>
    <?php echo isset($_SESSION['errores-entradas']) ? mostrarError($_SESSION['errores-entradas'], 'descripcion') : ''; ?>
    <label>Categoria:</label>
    <select name="categoria">
      <?php
      $categorias = conseguirCategorias($db);
      if (!empty($categorias)) :
        while ($categoria = mysqli_fetch_assoc($categorias)) :
      ?>
          <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entrada_editar['categoria_id'] ? 'selected="selected"' : '') ?>>
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
<?php require_once 'includes/footer.php'; ?>