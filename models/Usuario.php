<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password_nuevo2 = $args['password_nuevo2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validar login 
    public function validarLogin() {
        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es obligatorio';
        }

        return self::$alertas;
    }

    //Validacion de cuentas nuevas
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del Usuario es obligatorio';
        }

        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email del Usuario es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es obligatorio';
        }

        if(strlen($this->password) < 6 ) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }

        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    //Valida un email
    public function validarEmail() {

        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    //Validar password
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es obligatorio';
        }

        if(strlen($this->password) < 6 ) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validar_perfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del Usuario es obligatorio';
        }
        if(!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'El password actual obligatorio';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El password nuevo es obligatorio';
        }
        if(strlen($this->password_nuevo) < 6 ) {
            self::$alertas['error'][] = 'El password nuevo debe contener al menos 6 caracteres';
        }
        if($this->password_nuevo !== $this->password_nuevo2) {
            self::$alertas['error'][] = 'Las contraseñas nuevas no coinciden';
        }
        return self::$alertas;
    }

    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password);
    }

    //hashea password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Obtener token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}