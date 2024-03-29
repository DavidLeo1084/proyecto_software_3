<?php
require 'includes/app.php';
// require 'includes/config/database.php';
$db = conectarDB();
$errores = [];

// Autenticar usuario y sanitizar variables 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }
    if (!$password) {
        $errores[] = "El password es obligatorio";
    }
    if (empty($errores)) {
        // Revisar si hay errores
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
        // Consultar si hay existe el usuario con el email buscado
        if ($resultado->num_rows) {
            // Validación del password
            $usuario = mysqli_fetch_assoc($resultado);
            // Verificar si el password es correcto o no es correcto
            $autenticar = password_verify($password, $usuario['password']);

            if ($autenticar) {
                session_start();
                // LLenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location:/admin/index.php');
                
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}
// require 'includes/funciones.php';

incluirTemplates('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión como Administrador</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>E-mail y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu E-mail" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu password" id="password" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>
<?php
incluirTemplates('footer');
// include './includes/templates/footer.php';
?>
