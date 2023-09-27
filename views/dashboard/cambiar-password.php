<?php include_once __DIR__ . '/header-dashboard.php' ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <a href="/perfil" class="enlace">Volver a perfil</a>

    <form method="POST" class="formulario" action="/cambiar-password">
        <div class="campo">
            <label for="password_actual">Password Actual</label>
            <input 
                type="password"
                name="password_actual"
                placeholder="Tu Password Actual"
            />
        </div>

        <div class="campo">
            <label for="password_nuevo">Nuevo Password</label>
            <input 
                type="password"
                name="password_nuevo"
                placeholder="Tu Password Nuevo"
            />
        </div>

        <div class="campo">
            <label for="password_nuevo2">Confirmar Password</label>
            <input 
                type="password"
                name="password_nuevo2"
                placeholder="Repite Password Nuevo"
            />
        </div>

        <input id="guardar-pefil" type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>