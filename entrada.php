<?php
require 'includes/funciones.php';

// include './includes/templates/header.php';
incluirTemplates('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2022</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
         
            <p>
                Etiam quis suscipit nibh, faucibus viverra augue. Vestibulum eget efficitur nisi. Aliquam iaculis
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


    </main>
    <?php
incluirTemplates('footer');
// include './includes/templates/footer.php';
?>