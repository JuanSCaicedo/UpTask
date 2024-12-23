<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('info@juandevops.com', 'Juan Caicedo Cuentas');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        // Inicializar la variable $contenido
        $contenido = "";

        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado tu cuenta con UpTask. Haz clic en el siguiente enlace para confirmar tu cuenta:</p>";
        $contenido .= "<p><a href='". $_ENV['APP_URL'] ."/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email
        $mail->send();
    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('info@juandevops.com', 'Juan Caicedo Cuentas');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Cambia tu contraseña';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        // Inicializar la variable $contenido
        $contenido = "";

        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has solicitado cambiar la contraseña de tu cuenta con UpTask.
        Haz clic en el siguiente enlace para cambiar la contraseña:</p>";
        $contenido .= "<p><a href='". $_ENV['APP_URL'] ."/restablecer?token=" . $this->token . "'>Cambiar la contraseña</a></p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email
        $mail->send();
    }


}
