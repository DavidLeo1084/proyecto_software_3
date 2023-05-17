<?php

namespace Model;
class Vendedores extends ActiveRecord
{

    protected static $tabla = 'arriendatarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'cedula', 'telefono', 'direccion', 'correo',
    'tarifa'];

    public $id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $telefono;
    public $direccion;
    public $correo;
    public $tarifa;
    
    
    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->tarifa = $args['tarifa'] ?? '';
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

        if (!$this->correo) {
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

        return self::$errores;
    }
}
