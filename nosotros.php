<?php
require 'includes/funciones.php';
// include './includes/templates/header.php';
incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p> Etiam quis suscipit nibh, faucibus viverra augue. Vestibulum eget efficitur nisi. Aliquam iaculis
                    interdum neque in malesuada. Donec et sem arcu. Aenean dapibus sapien vel lorem vestibulum, volutpat
                    cursus sapien placerat. Sed ante nisi, iaculis quis vulputate eu, pulvinar quis orci.
                    Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus
                    cursus ligula non turpis convallis, at eleifend diam rutrum. Donec ullamcorper aliquet dolor, ac
                    sollicitudin sapien. Praesent cursus egestas leo, in mollis mauris vulputate sed. Cras porttitor
                    turpis at dolor ultricies, in vestibulum dolor sollicitudin.
                </p>
                <p>
                    Donec convallis tortor eu arcu imperdiet, sit amet tincidunt nunc tempus. Fusce sagittis auctor eros
                    et elementum. Curabitur lorem ante, semper sed elementum a, pharetra sed nisi. Integer dui quam,
                    tincidunt et molestie id, laoreet maximus ligula. Nulla rutrum quis odio id faucibus. Vestibulum et
                    velit eget nulla semper pulvinar euismod ac est.
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <!-- <img src="src/img/icono1.svg" alt="Icono Seguridad" loading="lazy"> -->
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Pellentesque et tellus eget urna lobortis sollicitudin. Vestibulum a justo finibus, bibendum est at,
                    tincidunt nulla. Praesent vulputate est nunc, at faucibus turpis feugiat vitae. Sed in accumsan
                    dolor, vitae scelerisque nibh. Suspendisse potenti. Sed tincidunt lacinia egestas.</p>
            </div>

            <div class="icono">
                <!-- <img src="src/img/icono2.svg" alt="Icono Precio" loading="lazy"> -->
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Pellentesque et tellus eget urna lobortis sollicitudin. Vestibulum a justo finibus, bibendum est at,
                    tincidunt nulla. Praesent vulputate est nunc, at faucibus turpis feugiat vitae. Sed in accumsan
                    dolor, vitae scelerisque nibh. Suspendisse potenti. Sed tincidunt lacinia egestas.</p>
            </div>

            <div class="icono">
                <!-- <img src="src/img/icono3.svg" alt="Icono Tiempo" loading="lazy"> -->
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">

                <h3>A Tiempo</h3>
                <p>Pellentesque et tellus eget urna lobortis sollicitudin. Vestibulum a justo finibus, bibendum est at,
                    tincidunt nulla. Praesent vulputate est nunc, at faucibus turpis feugiat vitae. Sed in accumsan
                    dolor, vitae scelerisque nibh. Suspendisse potenti. Sed tincidunt lacinia egestas.</p>
            </div>
        </div>
    </section>

    <?php
incluirTemplates('footer');
// include './includes/templates/footer.php';
?>