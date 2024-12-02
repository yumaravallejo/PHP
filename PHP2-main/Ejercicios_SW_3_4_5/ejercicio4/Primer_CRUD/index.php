<?php
session_start();
require "src/ctes_funciones.php";

if (isset($_POST["btnContEditar"])) {
    //Errores cuándo edito
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 30;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;
    if (!$error_usuario) {
        $url = DIR_SERV . "/repetido/usuarios/usuario/" . $_POST["usuario"] . "/id_usuario/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }

        if (isset($obj->error)) {
            session_destroy();
            die(error_page("ERROR", "<p>" . $obj->error . "</select></p>"));
        }

        $error_usuario = $obj->repetido;
    }
    $error_clave = strlen($_POST["clave"]) > 15;
    $error_email = $_POST["email"] == "" || strlen($_POST["email"]) > 50 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$error_email) {
        $url = DIR_SERV . "/repetido/usuarios/email/" . $_POST["email"] . "/id_usuario/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }

        if (isset($obj->error)) {
            session_destroy();
            die(error_page("ERROR", "<p>" . $obj->error . "</select></p>"));
        }

        $error_email = $obj->repetido;
    }

    $error_form = $error_nombre || $error_usuario || $error_clave || $error_email;

    if (!$error_form) {

        $url = DIR_SERV . "/actualizarUsuario/" . $_POST["btnContEditar"];
        $datos = array("nombre" => $_POST["nombre"], "usuario" => $_POST["usuario"], "clave" => md5($_POST["clave"]), "email" => $_POST["email"]);
        $respuesta = consumir_servicios_REST($url, "PUT", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }

        if (isset($obj->error)) {
            session_destroy();
            die(error_page("ERROR", "<p>" . $obj->error . "</select></p>"));
        }
        if (isset($obj->mensaje))
            $_SESSION["mensaje"] = $obj->mensaje;

        header("Location:index.php");
        exit();
    }
}

if (isset($_POST["btnContBorrar"])) {
    $url = DIR_SERV . "/borrarUsuario/" . $_POST["btnContBorrar"];
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    if (isset($obj->error)) {
        session_destroy();
        die("<p>" . $obj->error . "</select></p></body></html>");
    }

    if (isset($obj->mensaje))
        $_SESSION["mensaje"] = $obj->mensaje;

    header("Location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1º CRUD</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 50px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Listado de los usuarios</h1>
    <?php
    require "vistas/vista_tabla.php";

    if (isset($_POST["btnDetalle"])) {
        require "vistas/vista_detalle.php";
    } elseif (isset($_POST["btnBorrar"])) {
        require "vistas/vista_conf_borrar.php";
    } elseif (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"])) {
        require "vistas/vista_editar.php";
    } else {
        require "vistas/vista_nuevo.php";
    }


    ?>
</body>

</html>