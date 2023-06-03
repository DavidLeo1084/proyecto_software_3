<?php

namespace Model;

use MVC\Router;
use Model\Vendedores;
use Model\Propiedad;

class Admin extends ActiveRecord
{

    //Base de datos 
    protected static $tabla = 'usuarios';
    protected static $tabla2 = 'vendedores';

    protected static $columnasDB = ['id', 'email', 'password'];


    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El email es obligatorio';
        }

        if (!$this->password) {
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario()
    {

        if (self::$tabla === 'usuarios') {
            // Revisar si el usuario existe.
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);
            
        } elseif (self::$tabla2 === 'vendedores') {
            // Revisar si el usuario existe.
            debugear("algo");
            $query = "SELECT * FROM " . self::$tabla2 . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);
        }

        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }
        
        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $autenticado = false;
        $usuario = $resultado->fetch_object();

        // $passwordHash = hash('sha256', $this->password . $this->email['password']);
        // debugear($passwordHash);

        // debugear($passwordHash. ' contra ' . $usuario->password);
        // $autenticado = password_verify($this->password, $usuario->password);
        // if (!$autenticado )
        if ($this->password === $usuario->password) {
            // $autenticado = true;

            return $autenticado = true;
        }
        self::$errores[] = 'El Password es incorrecto';
        return $autenticado;
    }

    public function autenticar()
    {
        session_start();

        //Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}
