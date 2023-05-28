<?php

namespace Controller;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
use Intervention\Image\ImageManagerStatic as Image;

class Propiedad_controller
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();
       

        // Muestra mensaje de confirmación de creación de la propiedad
        $resultado = $_GET['resultado'] ?? null;

        $router->vista('paginas/index', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            
        ]); 
    }

    public static function admin(Router $router)
    {

        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();

        // Muestra mensaje de confirmación de creación de la propiedad
        $resultado = $_GET['resultado'] ?? null;

        $router->vista('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]); 
    }


    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedores::all();
        
        //Arreglo con mensaje de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            // Genera un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            
    // Realiza un resize a la imagen con Intervention */
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }


            // Validar 
            $errores = $propiedad->validar();
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos 
                $propiedad->guardar();
            }
        }
        $router->vista('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validar_direccionar('/admin');
        
        $propiedad = Propiedad::find($id);
        
        $vendedores = Vendedores::all();

        $errores = Propiedad::getErrores();

        // Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);

            // validación
            $errores = $propiedad->validar();

            // Genera un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            // Revisar que el array de errores este vacío
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->vista('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);


            if ($id) {

                $tipo = $_POST['tipo'];

                // Define tipo de objeto a eliminar
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
