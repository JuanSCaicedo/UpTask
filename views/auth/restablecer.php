<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';  ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';  ?>

        <?php if($mostrar){ ?>

        <form method="POST" class="formulario">

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>

            <input type="submit" class="boton" value="Cambiar Password">
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesisión</a>
            <a href="/crear">¿Aún no tienes una cuenta? Crear una</a>
        </div>
    </div>   <!-- contenedor-sm -->
</div>