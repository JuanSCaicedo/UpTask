<?php include_once __DIR__ . '/header-dashboard.php' ?>

<?php if (count($proyectos) == 0) { ?>
    <p class="no-proyectos">No Hay Proyectos Aún <br>
        <a href="/crear-proyecto">Comienza Creando Uno</a>
    </p>
<?php } else { ?>
    <ul class="listado-proyectos" id="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <li class="proyecto" data-id="<?= $proyecto->id; ?>">
                <a href="/proyecto?id=<?= $proyecto->url; ?>">
                    <?= $proyecto->proyecto; ?>
                </a>
                <button class="eliminar-proyecto fa-solid fa-trash" data-id="<?= $proyecto->id; ?>"></button>
            </li>
        <?php } ?>
    </ul>
<?php } ?>

<?php 
    include_once __DIR__ . '/footer-dashboard.php' 
?>
