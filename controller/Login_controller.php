<?php

namespace Controller;

use MVC\Router;
use Model\Admin;
use Model\Vendedores;
use Model\Propiedad;

class Login_controller
{

    public static function login(Router $router)
    {

        
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);
            $errores = $auth->validar();


            if (empty($errores)) {

                $resultado = $auth->existeUsuario();
                
                //Verificar si el usuario existe
                if (!$resultado) {
                    //Verificar si el usuario existe o no (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado =  $auth->comprobarPassword($resultado);
                    
                    // if (!$autenticado) 
                    if ($autenticado) {
                        //Autenticar el usuario
                        $auth->autenticar();
                    } else {
                        //password incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->vista('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function login_usuario(Router $router)
    {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Vendedores($_POST);
            $errores = $auth->validar();


            if (empty($errores)) {

                $resultado = $auth->existeUsuario();
                
                //Verificar si el usuario existe
                if (!$resultado) {
                    //Verificar si el usuario existe o no (mensaje de error)
                    $errores = Vendedores::getErrores();
                } else {
                    //Verificar el password
                    $autenticado =  $auth->comprobarPassword($resultado);
                    
                    // if ($autenticado) 
                    if (!$autenticado) {
                        //Autenticar el usuario
                        $auth->autenticar();
                    } else {
                        //password incorrecto (mensaje de error)
                        $errores = Vendedores::getErrores();
                    }
                }
            }
        }

        $router->vista('auth/login_usuario', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}
