<?php
require '../../includes/app.php';

estaAutenticado();

// Importar clases
use App\Propiedad;

//Implementar método para obtener todas las propiedades
$propiedades = Propiedad::all();

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
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                        </a>
                        <div class="mobile-menu">
                            <img src="/build/img/barras.svg" alt="icono menu responsive">

                        </div>
                        <div class="derecha">
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

            </div><!--.barra-->
        </div>
    </header>

    <main class="contenedor seccion">
        <h1>Bienes Raices Asignados</h1>
        <?php $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
        <?php  } ?>


        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach ($propiedades as $propiedad) : ?>
                    <tr>
                        <td class="listado-propiedades"><?php echo $propiedad->id; ?></td>
                        <td class="listado-propiedades"><?php echo $propiedad->titulo; ?></td>
                        <td class="listado-propiedades"><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                        <td class="listado-propiedades">$ <?php echo $propiedad->precio; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach ($vendedores as $vendedor) : ?>
                    <tr>
                        <td class="listado-propiedades"><?php echo $vendedor->id; ?></td>
                        <td class="listado-propiedades"><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td class="listado-propiedades"><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
//incluirTemplates('footer');
// include './includes/templates/footer.php';
?>