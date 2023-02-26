<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: / ');
}

require 'includes/config/database.php';
$db = conectarDB();

$query = "SELECT * FROM propiedades WHERE id = $id";

$resultadoConsulta = mysqli_query($db, $query);

if (!$resultadoConsulta->num_rows) {
    header('Location: / ');
}

$propiedad = mysqli_fetch_assoc($resultadoConsulta);

require 'includes/funciones.php';

// include './includes/templates/header.php';
incluirTemplates('header');

?>
<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <div class="resumen-propiedad">
        <picture>

            <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt=" imagen anuncio">
        </picture>

        <div class="contenido-anuncio">
            
            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio"><?php echo '$ ' . $propiedad['precio']; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

</main>
<?php
incluirTemplates('footer');
// include './includes/templates/footer.php';
mysqli_close($db);
?>