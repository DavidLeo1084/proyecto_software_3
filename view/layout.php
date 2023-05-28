<?php
if (!isset($_SESSION)) {
    session_start();
}
$autenticar = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/../../build/css/app.css">


</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">

                <?php if ($autenticar) : ?>

                    <a href="/admin">
                    <?php endif; ?>

                    <?php if (!$autenticar) : ?>

                        <a href="/">
                        <?php endif; ?>
                        <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                        </a>
                        <div class="mobile-menu">
                            <img src="build/img/barras.svg" alt="icono menu responsive">
                        </div>
                        <div class="derecha">

                            <img class="dark-mode-boton bright-mode-boton" src="build/img/dark-mode.svg">

                            <nav class="navegacion">
                                <a href="/nosotros">Nosotros</a>
                                <a href="/propiedades">Anuncios</a>
                                <a href="/blog">Blog</a>
                                <a href="/contacto">Contacto</a>
                                <?php if ($autenticar) : ?>
                                    <a href="/logout">Cerrar Sesión</a>
                                <?php endif; ?>

                                <?php if (!$autenticar) : ?>

                                    <ul class="desplegable">
                                        <li class="alinear-li"><a href="">Iniciar Sesión</a>

                                            <ul class="desple">
                                                <li><a href="/login">Sesión Administrador</a></li>
                                                <li><a href="/login_usuario">Sesión Usuario</a></li>
                                            </ul>

                                        </li>

                                    </ul>


                                <?php endif; ?>
                            </nav>



                        </div>
            </div>
            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos Reservados 2022 &copy;</p>
    </footer>

    <script src="/build/js/app.js"></script>

    <script src="/build/js/modernizr.js"></script>

</body>

</html>