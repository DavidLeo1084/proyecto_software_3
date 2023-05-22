<?php

require_once __DIR__ . '/../includes/app.php';

use Controller\Login_controller;
use MVC\Router;
use Controller\Propiedad_controller;
use Controller\Vendedores_controller;
use Controller\Paginas_controller;

$router = new Router();

//URl´s privadas
$router->get('/admin', [Propiedad_controller::class, 'admin']);
$router->get('/propiedades/crear', [Propiedad_controller::class, 'crear']);
$router->post('/propiedades/crear', [Propiedad_controller::class, 'crear']);
$router->get('/propiedades/actualizar', [Propiedad_controller::class, 'actualizar']);
$router->post('/propiedades/actualizar', [Propiedad_controller::class, 'actualizar']);
$router->post('/propiedades/eliminar', [Propiedad_controller::class, 'eliminar']);


$router->get('/vendedores/crear', [Vendedores_controller::class, 'crear']);
$router->post('/vendedores/crear', [Vendedores_controller::class, 'crear']);
$router->get('/vendedores/actualizar', [Vendedores_controller::class, 'actualizar']);
$router->post('/vendedores/actualizar', [Vendedores_controller::class, 'actualizar']);
$router->post('/vendedores/eliminar', [Vendedores_controller::class, 'eliminar']);

//Url´s publicas 
$router->get('/', [Paginas_controller::class, 'index']);
$router->get('/nosotros', [Paginas_controller::class, 'nosotros']);
$router->get('/propiedades', [Paginas_controller::class, 'propiedades']);
$router->get('/propiedad', [Paginas_controller::class, 'propiedad']);
$router->get('/blog', [Paginas_controller::class, 'blog']);
$router->get('/entrada', [Paginas_controller::class, 'entrada']);
$router->get('/contacto', [Paginas_controller::class, 'contacto']);
$router->post('/contacto', [Paginas_controller::class, 'contacto']);

// Login y autenticación
$router->get('/login', [Login_controller::class, 'login']);
$router->post('/login', [Login_controller::class, 'login']);
$router->get('/logout', [Login_controller::class, 'logout']);

$router->get('/login_usuario', [Login_controller::class, 'login_usuario']);




$router->comprobarRutas();
