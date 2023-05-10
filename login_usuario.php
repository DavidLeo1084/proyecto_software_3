<?php
require 'includes/app.php';

// Importar clases
use App\Propiedad;
use App\Vendedores;

$vendedores = Vendedores::all();
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
        $query = "SELECT * FROM vendedores WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
        // Consultar si hay existe el usuario con el email buscado

        if ($resultado->num_rows) {
            // Validación del password
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto o no es correcto
            $autenticar = $password === $usuario['password'];

            // var_dump($password);
            // exit;
            if ($autenticar) {
                session_start();
                // LLenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['usuario'] = $usuario;
                $_SESSION['login'] = true;
                foreach ($vendedores as $vendedor) :
                    if ($vendedor->id === $usuario['id'] ) {
                        // var_dump($vendedor->id);
                        // exit;
                        header('Location:/admin/vendedores/index.php'. '?' . 'id=' . $vendedor->id);
                    }

                endforeach;

                // debugear($usuario);

                
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
    <h1>Iniciar Sesión como Vendedor(a)</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    < <form method="POST" class="formulario">
        <fieldset>
            <legend>E-mail y Password del Vendedor(a)</legend>

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