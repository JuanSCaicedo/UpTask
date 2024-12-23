<div class="barra-mobile">
    <h1>UpTask</h1>

    <div class="menu">
        <img id="mobile-menu" src="build/img/menu.svg" alt="imagen Menú">
    </div>

</div>

<div class="barra">
    <p>Hola: <span>
            <?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Invitado'; ?>
        </span></p>

    <a href="/logout" class="cerrar-sesion">Cerrar sesión</a>
</div>