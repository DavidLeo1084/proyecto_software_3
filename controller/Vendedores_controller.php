<?php

namespace Controller;

use MVC\Router;
use Model\Vendedores;

class Vendedores_controller
{

    public static  function crear(Router $router)
    {

        $errores = Vendedores::getErrores();

        $vendedores = new Vendedores;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva instancia
            $vendedores = new Vendedores($_POST['vendedores']);

            // Validar que no haya campos vacíos
            $errores = $vendedores->validar();

            // No hay errores
            if (empty($errores)) {
                $vendedores->guardar();
            }
        }
        $router->vista('vendedores/crear', [
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function actualizar(Router $router)
    {

        $errores = Vendedores::getErrores();
        $id = validar_direccionar('/admin');

        //Obtener datos del vendededor a actualizar
        $vendedores = Vendedores::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Asignar los valores
            $args = $_POST['vendedores'];

            // Sincronizar el objeto en memoria con el objeto en BD
            $vendedores->sincronizar($args);

            // Validación
            $errores = $vendedores->validar();


            if (empty($errores)) {
                $vendedores->guardar();
            }
        }

        $router->vista('vendedores/actualizar', [
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static  function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //Valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedores = Vendedores::find($id);
                    $vendedores->eliminar(); 
                }
            }
        }
    }
}
