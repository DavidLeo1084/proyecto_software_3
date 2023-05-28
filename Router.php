<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        // $rutas_protegidas = [
        //     '/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
        //     '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'
        // ];
        $rutas_protegidas = [];

        // $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['PATH_INFO'];
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';


        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            // La url existe y hay una funcion asociada

            call_user_func($fn, $this);
            //   debugear($fn);  
        } else {

            echo "pagina no encontrada Error 404";
        }
    }

    // Muestra la vista
    public function vista($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();  // Almacenamiento en memoria durante un momento
        include __DIR__ . "/view/$view.php";
        $contenido = ob_get_clean();  // Limpia el buffer de la memoria
        include __DIR__ . "/view/layout.php";
    }
}
