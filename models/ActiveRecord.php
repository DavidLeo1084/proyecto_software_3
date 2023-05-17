<?php

namespace Model;


class ActiveRecord {

     //Base de datos
     protected static $db;
     protected static $columnasDB = [];

     protected static $tabla = '';
 
     //Errores
     protected static $errores = [];
 
     
 
     //Definir la conexión a la base de datos
     public static function setDB($database)
     {
         self::$db = $database;
     }

     public function guardar()
     {
         if (!is_null($this->id)) {
             //actualizar
             $this->actualizar();
         } else {
             // crear nuevo registro
             $this->crear();
         }
     }
 
     public function crear()
     {
         //Sanitizar los datos de entrada
         $atributos = $this->sanitizarAtributos();
 
         //Insertar en la base de datos 
         $query = " INSERT INTO " . static::$tabla . " ( ";
         $query .= join(', ', array_keys($atributos));
         $query .= " ) VALUES ( '";
         $query .= join("', '", array_values($atributos));
         $query .= "' )";
 
         $resultado = self::$db->query($query);
 
         //Mensaje de éxito o error
         if ($resultado) {
             //Redireccionar al usuario
             header('Location: /admin?resultado=1');
         }
     }
 
     public function actualizar()
     {
         //Sanitizar los datos de entrada
         $atributos = $this->sanitizarAtributos();
 
         $valores = [];
         foreach ($atributos as $key => $value) {
             $valores[] = "{$key} = '{$value}'";
         }
         $query = " UPDATE " . static::$tabla . " SET ";
         $query .= join(', ', $valores);
         $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
         $query .= " LIMIT 1 ";
 
         $resultado = self::$db->query($query);
         
         if ($resultado) {
             // Redireccionar al usuario
             header('Location: /admin?resultado=2');
         }
         //return $resultado;  
     }
 
     // Elimina el registro
     public function eliminar()
     {
         $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
         $resultado = self::$db->query($query);
 
         if ($resultado) {
             $this->borrarImagen();
             header('Location: /admin?resultado=3');
         }
     }
 
     //Identicar y unir los atributos en la base de datos
     public function atributos()
     {
         $atributos = [];
         foreach (static::$columnasDB as $columna) {
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
         // Elimina la imagen previa
         if (!is_null($this->id)) {
             $this->borrarImagen();
         }
         // Asignar al atributo de imagen al nombre de la imagen
         if ($imagen) {
             $this->imagen = $imagen;
         }
     }
 
     // Elimina el archivo
     public function borrarImagen()
     {
         //Comprueba si existe la imagen para eliminar
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
         if ($existeArchivo) {
             unlink(CARPETA_IMAGENES . $this->imagen);
         }
     }
 
     //Validaciones
     public static function getErrores()
     {
         return static::$errores;
     }
 
     public function validar()
     {
         static::$errores = [];
         return static::$errores;
     }
 
     //Enlistar todas los registros de las propiedades
     public static function all()
     {
         $query = "SELECT * FROM " . static::$tabla;
         $resultado = self::consultarSQL($query);
         return $resultado;
     }
     // Enlistar todos las propiedades asignados a un vendedor en especifico
     public static function selected($id) {
        

        // $query = "SELECT * FROM propiedades WHERE vendedores_id = $id";
        $query = "SELECT * FROM " . static::$tabla . " WHERE vendedores_id = $id";
        
        $resultado = self::consultarSQL($query);
        return $resultado;
     }

     //Obtiene determinado numero de propiedades a visualizar
     public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);
        return $resultado;
     }
 
     //Buscar propiedad por id
     public static function find($id)
     {
         $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
         $resultado = self::consultarSQL($query);
         return array_shift($resultado);
     }
     //consultar la base de datos
     public static function consultarSQL($query)
     {
         $resultado = self::$db->query($query);
 
         //Iterar los resultados
         $array = [];
         while ($registro = $resultado->fetch_assoc()) {
             $array[] = static::crearObjeto($registro);
         }
 
         //Liberar la memoria
         $resultado->free();
 
         //retornar los resultados
         return $array;
     }
     protected static function crearObjeto($registro)
     {
         $objeto = new static;
         foreach ($registro as $key => $value) {
             if (property_exists($objeto, $key)) {
                 $objeto->$key = $value;
             }
         }
         return $objeto;
     }
 
     // Sincroniza el objeto en memoria con los cambios realizados por el usuario
     public function sincronizar($args = [])
     {
         foreach ($args as $key => $value) {
             if (property_exists($this, $key) && !is_null($value)) {
                 $this->$key = $value;
             }
         }
     }
}