<?php

require '../../includes/app.php';

use App\Propiedad;
use App\Vendedores;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad = new Propiedad;

// Consulta para obtener todos los vendedores
$vendedores = Vendedores::all();

//Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

//ejecuta el codigo una vez el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //debugear($_POST);
    // Crea una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    // Genera un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    /**Setear la imagen en el servidor 
    Realiza un resize a la imagen con Intervention */
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }


    // Validar 
    $errores = $propiedad->validar();
    if (empty($errores)) {

        // Crear la carpeta para subir imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        // Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guarda en la base de datos 
        $propiedad->guardar();
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
        <h1>Crear</h1>

        <a href="/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
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

    <script src="/build/js/app.js"></script>
    <script src="/build/js/modernizr.js"></script>

</body>

</html>

<?php
// Cerrar la conexión
mysqli_close($db);
?>