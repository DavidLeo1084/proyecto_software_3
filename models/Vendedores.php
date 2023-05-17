<?php

namespace Model;
// use App\ActiveRecord;

class Vendedores extends ActiveRecord
{

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
}
