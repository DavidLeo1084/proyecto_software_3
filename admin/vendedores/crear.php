<?php

require '../../includes/app.php';

use App\Vendedores;

estaAutenticado();

$vendedores = new Vendedores;

//Arreglo con mensaje de errores
$errores = Vendedores::getErrores();

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

if (!isset($_SESSION)) {
    session_start();
}
$autenticar = $_SESSION['login'] ?? false;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../../build/css/app.css">

</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">

                <?php if ($autenticar) : ?>
                    <a href="/admin/index.php">
                    <?php endif; ?>

                    <?php if (!$autenticar) : ?>
                        <a href="/index.php">
                        <?php endif; ?>
                        <!-- <img src="../src/img/logo.svg" alt="Logotipo de Bienes Raices"> -->
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                        </a>
                        <div class="mobile-menu">
                            <!-- <img src="../src/img/barras.svg" alt="icono menu responsive"> -->
                            <img src="/build/img/barras.svg" alt="icono menu responsive">

                        </div>
                        <div class="derecha">
                            <!-- <img class="dark-mode-boton" src="../src/img/dark-mode.svg"> -->
                            <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                            <nav class="navegacion">
                                <a href="/nosotros.php">Nosotros</a>
                                <a href="/anuncios.php">Anuncios</a>
                                <a href="/blog.php">Blog</a>
                                <a href="/contacto.php">Contacto</a>
                                <?php if ($autenticar) : ?>
                                    <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                                <?php endif; ?>
                            </nav>
                        </div>
            </div>
            <!--.barra-->
            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>

    <main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1> 

        <a href="/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">    
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos Reservados 2022 &copy;</p>
    </footer>