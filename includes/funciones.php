<?php

// require 'app.php';
define('TEMPLATES_URL', __DIR__. '/templates');
define('FUNCIONES_URL', __DIR__. 'funciones.php');

function incluirTemplates($nombre, $inicio = false)
{
    include TEMPLATES_URL . "/$nombre.php";
}
function estaAutenticado(): bool{
    session_start();

    $autenticar = $_SESSION['login'];
    if ($autenticar) {
        return true;
    }
        return false;

}