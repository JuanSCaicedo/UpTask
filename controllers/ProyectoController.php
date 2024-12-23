<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class ProyectoController
{
    public static function index()
    {
        session_start();
        isAuth();

        $proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['id']);

        $proyectoNoValido = false; // Bandera para indicar si se encuentra un proyecto no válido

        foreach ($proyectos as $proyecto) {
            $propietarioId = $proyecto->propietarioId;
            if ($propietarioId !== $_SESSION['id']) {
                $proyectoNoValido = true; // Establece la bandera si se encuentra un proyecto no válido
                break; // Sale del bucle
            }
        }

        if ($proyectoNoValido) {
            header('Location: /404'); // Redirige si se encuentra un proyecto no válido
        }

        if (!$proyectos) {
            $proyectos = [];
        }

        echo json_encode(['proyectos' => $proyectos]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            isAuth();

            $proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['id']);

            if (!$proyectos)
                header('Location: /404');

            $proyecto = new Proyecto($_POST);

            $resultado = $proyecto->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Eliminado correctamente',
                'tipo' => 'exito'
            ];

            echo json_encode($resultado);
        }
    }
}