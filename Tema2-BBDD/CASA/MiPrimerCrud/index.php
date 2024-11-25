<?php
session_name('mensajeria');
session_start();
require "src/funciones.php";

/* DETALLES USUARIO */
if (isset($_POST['btnDetalles'])) {
    try {
        if (isset($_POST['btnDetalles'])) $valor = $_POST['btnDetalles'];
        $consulta = "select * from usuarios where id_usuario = '" . $valor . "'";
        $detalle = mysqli_query($conexion, $consulta);
        $detalle_usuario = mysqli_fetch_assoc($detalle);
        $n_tupla = mysqli_num_rows($detalle);
        mysqli_free_result($detalle);
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die("<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>");
    }
}

/* ERRORES INSERTAR */
if (isset($_POST['btnContInsertar'])) {
    function usuario_repe($usuario, $conexion)
    {
        try {
            $consulta = "select * from usuarios where usuario = '" . $usuario . "'";
            $usuario = mysqli_query($conexion, $consulta);
            return mysqli_num_rows($usuario) != 0 ? false : true;
            mysqli_free_result($usuario);
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die("<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>");
        }
    }

    $error_nombre = $_POST['nombre'] == "";
    $error_usuario = $_POST['usuario'] == "" || !usuario_repe($_POST['usuario'], $conexion);
    $error_clave = $_POST['clave'] == "";
    $error_email = $_POST['email'] == "" || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);;
    $errores_form = $error_nombre || $error_usuario || $error_clave || $error_email;
}

/* INSERTAR USUARIO */
if (isset($_POST['btnContInsertar']) && !$errores_form) {
    try {
        $consulta = "insert into usuarios (nombre, usuario, clave, email) values ('" . $_POST['nombre'] . "','" . $_POST['usuario'] . "','" . $_POST['clave'] . "','" . $_POST['email'] . "')";
        $insertar = mysqli_query($conexion, $consulta);
        $_SESSION['mensaje_completado'] = "USUARIO INSERTADO CON ÉXITO";
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die("<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>");
    }
}

try {
    $consulta = "select * from usuarios";
    $usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die("<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Crud Casa</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 0.5rem
        }

        .enlace {
            color: blue;
            text-decoration: underline;
            background-color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    require("vistas/vista_principal.php");

    if (isset($_POST['btnDetalles'])) require("vistas/vista_detalles.php");
    if (isset($_POST['btnBorrar'])) require("vistas/vista_borrar.php");
    if (isset($_POST['btnEditar']) || (isset($_POST['btnContEditar']) && $errores_form)) require("vistas/vista_editar.php");
    if (isset($_POST['btnInsertar']) || (isset($_POST['btnContInsertar']) && $errores_form)) require("vistas/vista_insertar.php");
    if (isset($_SESSION['mensaje_completado'])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje_completado"] . "</p>";
        session_destroy();
    }

    mysqli_free_result($usuarios);
    ?>
</body>

</html>