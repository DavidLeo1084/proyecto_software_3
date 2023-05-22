<?php

// require 'app.php';
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplates(String $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/$nombre.php";
}
function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}
function debugear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa el HTML

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Valida tipo de contenido

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes de aprobacion de crud
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado correctamente';
            break;

        case 3:
            $mensaje = 'Eliminado correctamente';
            break;

        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validar_direccionar(String $url)
{
    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }
    return $id;
}
