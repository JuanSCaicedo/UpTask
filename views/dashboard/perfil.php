<?php include_once __DIR__ . '/header-dashboard.php' ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <a href="/cambiar-password" class="enlace">Cambiar Password</a>

    <form method="POST" class="formulario" action="/perfil">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input 
                type="text"
                value="<?php echo $usuario->nombre; ?>"
                name="nombre"
                placeholder="Tu nombre"
            />
        </div>

        <div class="campo">
            <label for="email">Email</label>
            <input 
                type="text"
                value="<?php echo $usuario->email; ?>"
                name="email"
                placeholder="Tu Email"
            />
        </div>

        <input id="guardar-pefil" type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>