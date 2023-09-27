<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';  ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesisión</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';  ?>

        <form action="/" method="POST" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>

            <input type="submit" class="boton" value="Iniciar Sesisión">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Crear una</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div>   <!-- contenedor-sm -->
</div>

<?php include_once __DIR__ . '/../templates/appJs.php';  ?>