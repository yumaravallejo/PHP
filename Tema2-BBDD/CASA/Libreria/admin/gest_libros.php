<?php
session_name("libreria_exam");
session_start();

require "../src/funciones.php";

if (isset($_POST["btnCerrarSesion"])) {
    session_destroy();
    header("Location:../index.php");
    exit;
}

if (isset($_POST['btnContBorrar'])) {
    try {
        $sentencia = "DELETE FROM libros WHERE referencia = '" . $_POST['btnContBorrar'] . "'";
        mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die("No ha podido realizarse la consulta a la BD " . $e->getMessage());
    }

    $_SESSION['mensaje_inf'] = "<p>Se ha borrado el libro con éxito</p>";
}

if (isset($_POST["btnAgregar"])) {

    // Error en la referencia, si está vacio, no es un número o es menor a 0
    $error_referencia = $_POST["referencia"] == "" || !is_numeric($_POST["referencia"]) || $_POST["referencia"] < 0;
    // Si no tiene errores comprueba si está repetido
    if (!$error_referencia) {
        $error_referencia = repetido($conexion, "libros", "referencia", $_POST["referencia"]);
        // si es string es pq ha habido un error en la consulta
        if (is_string($error_referencia)) {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen3 Curso 23-24", "<h1>Librería</h1><p>Error en la consulta: " . $error_referencia . "</p>"));
        }
    }
    // Error de titulo, autor y descripcion vacios
    $error_titulo = $_POST["titulo"] == "";
    $error_autor = $_POST["autor"] == "";
    $error_descripcion = $_POST["descripcion"] == "";
    // Error del precio controlado que se un numero mayor a 0
    $error_precio = $_POST["precio"] == "" || !is_numeric($_POST["precio"]) || $_POST["precio"] <= 0;

    // Comprobacion de errores en la imagen
    $array_nombre = explode(".", $_FILES["portada"]["name"]);
    $error_portada = $_FILES["portada"]["name"] != "" && ($_FILES["portada"]["error"] || !$array_nombre || !getimagesize($_FILES["portada"]["tmp_name"]) || $_FILES["portada"]["size"] > 750 * 1024);

    $error_form = $error_referencia || $error_titulo || $error_autor || $error_descripcion || $error_precio || $error_portada;
    // si no hay ningun error agrega el libro
    if (!$error_form) {
        // consulta para agregar
        try {
            $consulta = "insert into libros(referencia, titulo, autor,descripcion,precio) values('" . $_POST["referencia"] . "','" . $_POST["titulo"] . "','" . $_POST["autor"] . "','" . $_POST["descripcion"] . "','" . $_POST["precio"] . "')";
            mysqli_query($conexion, $consulta);
        } catch (Exception $e) {

            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen3 Curso 23-24", "<h1>Librería</h1><p>Error en la consulta: " . $e->getMessage() . "</p>"));
        }

        // se guarda un msj que indica que se ha podido agregar el libro
        $_SESSION["mensaje_inf"] = "Libro agregado con éxito";

        // Si se ha subido una portada
        if ($_FILES["portada"]["name"] != "") {
            $ext = end($array_nombre);
            $nombre_nuevo = "img" . $_POST["referencia"] . "." . $ext;
            @$var = move_uploaded_file($_FILES["portada"]["tmp_name"], "../img/" . $nombre_nuevo);
            // si no ha habido error en mover la imagen a la carpeta de img
            // se actualiza el libro
            if ($var) {
                try {
                    $consulta = "update libros set portada='" . $nombre_nuevo . "' where referencia='" . $_POST["referencia"] . "'";
                    mysqli_query($conexion, $consulta);
                } catch (Exception $e) {
                    // no se que pasa aqui
                    unlink("../img/" . $nombre_nuevo);
                    session_destroy();
                    mysqli_close($conexion);
                    die(error_page("Examen3 Curso 23-24", "<h1>Librería</h1><p>Error en la consulta: " . $e->getMessage() . "</p>"));
                }
            } else {
                $_SESSION["accion"] = "Libro agregado con éxito pero con la imagen por defecto por no poder mover la imagen subida a la carpeta destino";
            }
        }

        mysqli_close($conexion);
        header("Location:gest_libros.php");
        exit;
    }
}


try {
    $consulta = "SELECT * from libros";
    $libros = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die("No se ha podido realizar la consulta en la BD " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
    <style>
        .enlace {
            text-decoration: underline;
            border: none;
            background-color: white;
            color: blue;
        }

        table {
            border-collapse: collapse;
        }

        th {
            background-color: lightgray;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: .7rem;
            text-align: center;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION["usuario"])) {

        $salto = "../index.php";

        require "../src/seguridad.php";

        if ($datos_usuario_logueado["tipo"] == "admin") {
            require "../vistas/vista_admin.php";
        } else {
            header("Location:../index.php");
            exit;
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
