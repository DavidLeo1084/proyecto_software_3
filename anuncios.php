<?php
require 'includes/app.php';
// include './includes/templates/header.php';
incluirTemplates('header');
// Validar la URL por ID válido
// $id = $_GET['id'];
// $id = filter_var($id, FILTER_VALIDATE_INT);

// // if (!$id) {
// //     header('Location: /admin');
// // }

// // Consultar los datos de la propiedad

// $consulta = "SELECT * FROM propiedades WHERE id = $id";
// $resultadoConsulta = mysqli_query($db, $consulta);
// $propiedad = mysqli_fetch_assoc($resultadoConsulta);

?>
<main class="contenedor seccion">
    <h2>Casas y Apartamentos en Venta</h2>
    <?php
    $limite = 10;
    include 'includes/templates/anuncios.php';

    ?>
</main>
<?php
incluirTemplates('footer');
// include './includes/templates/footer.php';
?>