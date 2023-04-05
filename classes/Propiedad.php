<?php

namespace App;

class Propiedad
{
    //Base de datos
    protected static $db;
    protected static $columnasDB = [
        'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc',
        'estacionamiento', 'creado', 'vendedores_id'
    ];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    //Definir la conexión a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function guardar()
    {
        //Sanitizar los datos de entrada
        $atributos = $this->sanitizarAtributos();


        //Insertar en la base de datos 
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos));
        $query .= "' )";

        $resultado = self::$db->query($query);
        return $resultado;
    }
    //Identicar y unir los atributos en la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen)
    {
        // Asignar al atributo de imagen al nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Validaciones
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = "Se debe añadir un título";
        }
        if (!$this->precio) {
            self::$errores[] = "Se debe añadir un precio";
        }
        if (strlen($this->descripcion) <  50) {
            self::$errores[] = "Se debe añadir una descripción no menor a 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "Se debe seleccionar un número de habitaciones";
        }
        if (!$this->wc) {
            self::$errores[] = "Se debe seleccionar un número de baños";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Se debe seleccionar un número de estacionamientos";
        }
        if (!$this->vendedores_id) {
            self::$errores[] = "Se debe seleccionar el nombre de un vendedor";
        }

        if (!$this->imagen) {
            self::$errores[] = "Se debe de agregar una imagen";
        }

        return self::$errores;
    }

    //Enlistar todas las propiedades
    public static function all()
    {

        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query)
    {

        //consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }
    protected static function crearObjeto($registro)
    {

        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
}
