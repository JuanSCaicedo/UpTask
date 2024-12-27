<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;
use Classes\Email;

class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();

        // Verificar si 'id' existe en la sesión antes de usarlo
        // Asignar un valor por defecto si 'id' no está en la sesión
        $id = $_SESSION['id'] ?? null;


        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public static function crear_proyecto(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            //Validación
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                //Generar URL
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //Almacenar el creado de proyecto
                $proyecto->propietarioId = $_SESSION['id'];

                //Guardar proyecto
                $proyecto->guardar();

                //Redireccionar
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router)
    {
        session_start();
        isAuth();

        $token = $_GET['id'];

        if (!$token)
            header('Location: /dashboard');
        //Validar propietario
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if (empty($alertas)) {
                $correoAnterior = $_SESSION['email'];
                $nombre = $usuario->nombre;

                if ($correoAnterior !== $usuario->email) {
                    $existeUsuario = Usuario::where('email', $usuario->email);

                    if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                        Usuario::setAlerta('error', 'Correo ya está registrado');
                    } else {
                        $usuario->crearToken();
                        $usuario->confirmado = 0;
                        $resultado = $usuario->guardar();

                        if ($resultado) {
                            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                            $email->enviarConfirmacion();
                            Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu correo 
                            para confirmar tu cuenta. ¡Recuerda confirmar antes de iniciar sesión!.');
                        }
                    }
                } else {
                    if (strlen($nombre) >= 40) {
                        Usuario::setAlerta('error', 'Máximo 40 caracteres');
                    } else {
                        $usuario->guardar();
                        Usuario::setAlerta('exito', 'Perfil actualizado correctamente.');
                    }
                }

                $_SESSION['email'] = $usuario->email;
                $_SESSION['nombre'] = $usuario->nombre;
                $alertas = $usuario->getAlertas();
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_password(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            //sincronizar usuario con sus datos
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevo_password();

            if (empty($alertas)) {
                $resultado = $usuario->comprobar_password();
                if ($resultado) {
                    $usuario->password = $usuario->password_nuevo;

                    //Eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    unset($usuario->password_nuevo2);

                    //Hasehar nuevo password
                    $usuario->hashPassword();

                    //Guardar nuevo password
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Contraseña actualizada correctamente.');
                    }
                } else {
                    Usuario::setAlerta('error', 'Contraseña incorrecta.');
                }
                $alertas = $usuario->getAlertas();
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Perfil',
            'alertas' => $alertas
        ]);
    }
}
