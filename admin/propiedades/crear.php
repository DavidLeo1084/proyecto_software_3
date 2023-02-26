<?php
require '../../includes/funciones.php';
// session_start();

$autenticar = estaAutenticado();

if (!$autenticar) {
    header('Location:/');
}

//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();
//Consultar para obtener los datos de los vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);



// var_dump($db);
//Arreglo con mensaje de errores
$errores = [];
//validar por tamaño (100 Kb máximo por imagen)
$medida = 4000 * 100;

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';

//ejecuta el codigo una vez el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
    $creado = date('Y/m/d');
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Se debe añadir un título";
    }
    if (!$precio) {
        $errores[] = "Se debe añadir un precio";
    }
    if (strlen($descripcion) <  50) {
        $errores[] = "Se debe añadir una descripción no menor a 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Se debe seleccionar un número de habitaciones";
    }
    if (!$wc) {
        $errores[] = "Se debe seleccionar un número de baños";
    }
    if (!$estacionamiento) {
        $errores[] = "Se debe seleccionar un número de estacionamientos";
    }
    if (!$vendedores_id) {
        $errores[] = "Se debe seleccionar el nombre de un vendedor";
    }
    if (!$imagen['name']) {
        $errores[] = "Se debe de agregar una imagen";
    }
    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen excede el tamaño de 4Mb";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // Revisar  que el array de errores este vacío
    if (empty($errores)) {

        //Subida de archivos
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = md5(uniqid(rand(), true)) . 'jpg';

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) 
    VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedores_id')";
        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //echo "Insertado correctamente";
            header('Location: /admin?resultado=1');
        }
    }
}
if (!isset($_SESSION)) {
    session_start();
}
$autenticar = $_SESSION['login'] ?? false;
var_dump($_SESSION);

// require '../../includes/funciones.php';

// include './includes/templates/header.php';
// incluirTemplates('header');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <!-- <link rel="stylesheet" href="/build/css/app.css"> -->
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?php $descripcion; ?></textarea>

            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
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
    <!-- <script src="../../build/js/app.js"></script>
    <script src="../../build/js/modernizr.js"></script> -->
    <!-- <script src="../src/js/modernizr.js"></script>
    <script src="../src/js/app.js"></script> -->

</body>

</html>
<!-- incluirTemplates('footer');
include './includes/templates/footer.php'; -->
<?php
// Cerrar la conexión
mysqli_close($db);

//incluirTemplates('footer');
// include './includes/templates/footer.php';
?>