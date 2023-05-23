<?php

namespace Model;

// use App\ActiveRecord;

class Vendedores extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'salario', 'comision',
    'cedula', 'direccion', 'password'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $salario;
    public $comision;
    public $cedula;
    public $direccion;
    public $password;
    
    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->salario = $args['salario'] ?? '';
        $this->comision = $args['comision'] ?? null;
        $this->cedula = $args['cedula'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato no valido";
        }

        if (!$this->email) {
            self::$errores[] = "El correo es obligatorio";
        }

        if (!$this->salario) {
            self::$errores[] = "El valor del salario es obligatorio";
        }

        if (!$this->cedula) {
            self::$errores[] = "El número de cédula es obligatorio";
        }

        if (!$this->direccion) {
            self::$errores[] = "La dirección es obligatoria";
        }

        if (preg_match('/[0-9]{10}/',!$this->password)) {
            self::$errores[] = "La contraseña es obligatoria";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        
        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        
        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }

        return $resultado;
    }


    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();
        
        $autenticado = password_verify($this->password, $usuario->password);
        

        if (!$autenticado) {
            self::$errores[] = 'El Password es incorrecto';
        }
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
