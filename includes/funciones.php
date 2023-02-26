<?php

require 'app.php';


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