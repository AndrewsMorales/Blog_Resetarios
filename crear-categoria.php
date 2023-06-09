<!-- Redireccion -->
<?php require_once 'includes/redireccion.php'; ?>
<!-- Cabecera -->
<?php require_once 'includes/header.php'; ?>
<!-- Siderbar -->
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
  <h1>Crear Categoria</h1>
  <p>
    Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas.
  </p>
  <br>
  <form action="actions/guardar-categoria.php" method="POST">
    <label>Nombre de la categoria:</label>
    <input type="text" name="nombre">
    <input type="submit" value="Guardar">
  </form>
</div>