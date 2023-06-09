<aside id="sidebar">
    <div id="buscardor" class="bloque">
        <h3>Buscar</h3>

        <form action="buscar.php" method="POST">
            <input type="text" id="busqueda" name="busqueda">

            <input class="boton" type="submit" value="Buscar">
        </form>
    </div>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']; ?></h3>
            <!--botones-->
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="actions/cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
        </div>
    <?php endif; ?>
    <?php if (!isset($_SESSION['usuario'])) : ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>
            <form action="actions/login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="off">

                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="off">

                <input class="boton" type="submit" value="Entrar">
            </form>
        </div>
        <div id="Register" class="bloque">
            <h3>Registrate</h3>
            <?php if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="actions/registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" autocomplete="off">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" autocomplete="off">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="off">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="off">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'contrasena') : ''; ?>

                <input class="boton" name="submit" type="submit" value="Registrar">
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>