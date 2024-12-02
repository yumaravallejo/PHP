<?php
session_start();
require "src/ctes_funciones.php";


if (isset($_POST["btnNuevoUsuario"]) || isset($_POST["btnContInsertar"])) {
    if (isset($_POST["btnContInsertar"])) // compruebo errores
    {
        $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 30;
        $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;
        if (!$error_usuario) {
            $url = DIR_SERV . "/repetido/usuarios/usuario/" . $_POST["usuario"];
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

        $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 15;
        $error_email = $_POST["email"] == "" || strlen($_POST["email"]) > 50 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if (!$error_email) {
            $url = DIR_SERV . "/repetido/usuarios/email/" . $_POST["email"];
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
            $url = DIR_SERV . "/crearUsuario";
            $datos = array("nombre" => $_POST["nombre"], "usuario" => $_POST["usuario"], "clave" => md5($_POST["clave"]), "email" => $_POST["email"]);
            $respuesta = consumir_servicios_REST($url, "POST", $datos);
            $obj = json_decode($respuesta);
            if (!$obj) {
                session_destroy();
                die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
            }

            if (isset($obj->error)) {
                session_destroy();
                die(error_page("ERROR", "<p>" . $obj->error . "</select></p>"));
            }

            if (isset($obj->ult_id))
                $_SESSION["mensaje"] = "Se ha insertado correctamente el usuario con id " . $obj->ult_id;
            header("Location:index.php");
            exit;
        }
    }
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Práctica 1º CRUD</title>
        <style>
            .error {
                color: red
            }
        </style>
    </head>

    <body>
        <h1>Usuario Nuevo</h1>
        <form action="usuario_nuevo.php" method="post">
            <p>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>">
                <?php
                if (isset($_POST["btnContInsertar"]) && $error_nombre) {
                    if ($_POST["nombre"] == "")
                        echo "<span class='error'> Campo vacío</span>";
                    else
                        echo "<span class='error'> Has tecleado más de 30 caracteres</span>";
                }
                ?>
            </p>
            <p>
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
                <?php
                if (isset($_POST["btnContInsertar"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<span class='error'> Campo vacío</span>";
                    elseif (strlen($_POST["usuario"]) > 20)
                        echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                    else
                        echo "<span class='error'> Usuario repetido</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña: </label>
                <input type="password" name="clave" maxlength="15" id="clave">
                <?php
                if (isset($_POST["btnContInsertar"]) && $error_clave) {
                    if ($_POST["clave"] == "")
                        echo "<span class='error'> Campo vacío</span>";
                    else
                        echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                }
                ?>
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="text" name="email" id="email" maxlength="50" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
                <?php
                if (isset($_POST["btnContInsertar"]) && $error_email) {
                    if ($_POST["email"] == "")
                        echo "<span class='error'> Campo vacío</span>";
                    elseif (strlen($_POST["email"]) > 50)
                        echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                        echo "<span class='error'> Email sintáxticamente incorrecto</span>";
                    else
                        echo "<span class='error'> Email repetido</span>";
                }
                ?>
            </p>
            <p>
                <button type="submit" name="btnContInsertar">Continuar</button>
                <button type="submit">Volver</button>
            </p>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location:index.php");
    exit;
}
?>