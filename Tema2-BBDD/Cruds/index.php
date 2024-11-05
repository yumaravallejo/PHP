<?php
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_foro";

/* CONEXIÓN CON LA BASE DE DATOS */
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Mi Primer CRUD", '<p>No se ha podido conectar a la base de datos "' . $e->getMessage() . '"</p>'));
}

/* FUNCIÓN QUE DEVUELVE UNA PÁGINA PARA UN ERROR */
function error_page($title, $body)
{
    return '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
                </head>
            <body>' . $body . '</body>
            </html>';
}

/* ----------------------------------------------------- */

/* INFORMACIÓN DE USUARIO CONCRETO */
if (isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"])) {
    if (isset($_POST["btnDetalles"])) $valor = $_POST["btnDetalles"];
    else if (isset($_POST["btnBorrar"])) $valor = $_POST["btnBorrar"];

    try {
        $consulta = "SELECT * FROM usuarios WHERE cod_user = '" . $valor . "'";
        $detalle_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Mi Primer Crud", '<p>No se ha podido realizar la consulta "' . $e->getMessage() . '"</p>'));
    }
}
/* ----------------------------------------------------- */


/* ELIMINAR ALGÚN USUARIO */
if (isset($_POST["btnBorrarDefinitivamente"])) {
    try {
        $consulta = "DELETE FROM usuarios WHERE cod_user = '" . $_POST["btnBorrarDefinitivamente"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Mi Primer Crud", '<p>No se ha podido realizar la consulta "' . $e->getMessage() . '"</p>'));
    }
}
/* ----------------------------------------------------- */

/* ERRORES DE FORMULARIO */
if (isset($_POST['agregarUser']) || isset($_POST['editarUser'])) {
    try {
        $consulta = "SELECT * FROM usuarios WHERE usuario = '" . $_POST['usuario'] . "'";
        $nombre_repetido = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Mi Primer Crud", '<p>No se ha podido realizar la consulta "' . $e->getMessage() . '"</p>'));
    }

    $formato_email = !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $user_repe = mysqli_num_rows($nombre_repetido) != 0;
    $errores_form = $_POST['nombre'] == "" ||  $_POST['usuario'] == ""  || $_POST['email'] == "" || $_POST['clave'] == "" || $user_repe || $formato_email;

    mysqli_free_result($nombre_repetido);
}
/* ----------------------------------------------------- */


/* INSERTAR UN USUARIO */
if (isset($_POST['agregarUser']) && !$errores_form) {
    try {
        $insertar = "INSERT INTO usuarios (cod_user, nombre, usuario, clave, email) VALUES (NULL, '" . $_POST['nombre'] . "', '" . $_POST['usuario'] . "', 'md5(" . $_POST['clave'] . ")', '" . $_POST['email'] . "')";
        mysqli_query($conexion, $insertar);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Mi Primer Crud", '<p>No se ha podido realizar la consulta "' . $e->getMessage() . '"</p>'));
    }
}

/* ----------------------------------------------------- */


/* INFORMACIÓN DE TODOS LOS USUARIOS */
try {
    $consulta = "SELECT * FROM usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Mi Primer Crud", '<p>No se ha podido realizar la consulta "' . $e->getMessage() . '"</p>'));
}
/* ----------------------------------------------------- */



/* CERRAMOS LA CONEXIÓN */
mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primer CRUD</title>
</head>
<style>
    table,
    tr,
    td,
    th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 3px;
        text-align: center;
    }

    .enlace {
        border: none;
        background: none;
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }

    .error {
        color: red;
    }
</style>

<body>
    <h1>Listado de los Usuarios</h1>
    <?php
    include("vistas/vistaPrincipal.php");

    if (isset($_POST['btnDetalles'])) {
        include("vistas/vistaDetalles.php");
    }

    if (isset($_POST['btnAgregar']) || isset($_POST['agregarUser'])) {
        if (isset($_POST['agregarUser']) && !$errores_form) {
            echo "<p class='mensaje'>Usuario añadidio con éxito</p>";
        } else {
            require("vistas/vistaAgregar.php");
        }
    }

    if (isset($_POST['btnBorrar'])) {
        include("vistas/vistaBorrar.php");
    }

    if (isset($_POST["btnBorrarDefinitivamente"])) {
        echo "<p>¡Borrado con exito el usuario!</p>";
    }

    if (isset($_POST["btnEditar"])) {
        include("vistas/vistaEditar.php");
    }
    ?>
</body>

</html>