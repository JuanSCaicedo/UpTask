<?php include_once __DIR__ . '/header-dashboard.php' ?>

<?php if (count($proyectos) == 0) { ?>
    <p class="no-proyectos">No Hay Proyectos Aún <br>
        <a href="/crear-proyecto">Comienza Creando Uno</a>
    </p>
<?php } else { ?>
    <ul class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <li>
                <a class="proyecto" href="/proyecto?id=<?= $proyecto->url; ?>"><?= $proyecto->proyecto; ?></a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>
