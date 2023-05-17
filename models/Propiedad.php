<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = [
        'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc',
        'estacionamiento', 'creado', 'vendedores_id'
    ];

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

    public function __construct($args = [])
     {
 
         $this->id = $args['id'] ?? null;
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
}
