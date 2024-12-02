<?php
session_name("ej3_SW");
session_start();
require "src/ctes_funciones.php";

if (isset($_POST["btnContInsertar"])) {
    require "vistas/vista_contInsertar.php";
}

if (isset($_POST["btnContEditar"])) {
    require "vistas/vista_contEditar.php";
}

if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location: index.php");
}

if (isset($_SESSION["usuario"])) {
    $url = DIR_SERV . "/login";
    $datos = array("usuario" => $_SESSION["usuario"], "clave" => $_SESSION["clave"]);
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die(error_page("ERROR", "<p>No has recibido un json </p>" . $respuesta));
    }

    if (isset($obj->mensaje_error)) {
        session_destroy();
        die(error_page("ERROR", "<p>" . $obj->mensaje_error . "</p>"));
    }

    if (isset($obj->mensaje)) {
        session_unset();
        $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la base de datos";
        header("Location: index.php");
        exit();
    }

    if (time() - $_SESSION["ult_accion"] > MINUTOS * 60) {
        session_unset();
        $_SESSION["seguridad"] = "Su tiempo de sesión ha caducado.";
        header("Location: index.php");
        exit();
    }

    $datos_usuario_log = $obj->usuario;
    $_SESSION["ult_accion"] = time();

    if ($datos_usuario_log->tipo == "normal") {
?>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ejercicio 2 - Servicios Web</title>
            <style>
                th,
                tr,
                td,
                table {
                    border: 1px solid black;
                }

                table {
                    border-collapse: collapse;
                    width: 80%;
                    margin: 0 auto;
                    text-align: center;
                }

                h2 {
                    text-align: center;
                }

                .enlace {
                    background: none;
                    color: blue;
                    text-decoration: underline;
                    border: none;
                    cursor: pointer;
                }

                .error {
                    color: red;
                }

                .mensaje {
                    color: blue;
                    font-size: 1.2rem;
                }

                .enlinea {
                    display: inline-block;
                }
            </style>
        </head>

        <body>
            <h1>App Login SW</h1>
            <div>Bienvenido <strong><?php echo $datos_usuario_log->usuario ?></strong> -
                <form class="enlinea" action="index.php" method="post">
                    <button class="enlace" type="submit" name="btnSalir">Salir</button>
                </form>
            </div>
            <h2>Listado de Productos</h2>

            <ul>
                <?php
                // Obtenemos todos los productos
                $url = DIR_SERV . "/productos";
                $respuesta = consumir_servicios_REST($url, "GET",);
                $obj = json_decode($respuesta);
                if (!$obj) {
                    session_destroy();
                    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
                }

                if (isset($obj->error)) {
                    session_destroy();
                    die("<p>" . $obj->error . "</p></body></html>");
                }

                foreach ($obj->productos as $tupla) {
                    echo "<li>" . $tupla->nombre_corto . " - " . str_replace(".", ",", $tupla->PVP) . "</li>";
                }
                ?>
            </ul>
        </body>

        </html>
    <?php
    } else {

    ?>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ejercicio 2 - Servicios Web</title>
            <style>
                th,
                tr,
                td,
                table {
                    border: 1px solid black;
                }

                table {
                    border-collapse: collapse;
                    width: 80%;
                    margin: 0 auto;
                    text-align: center;
                }

                h2 {
                    text-align: center;
                }

                .enlace {
                    background: none;
                    color: blue;
                    text-decoration: underline;
                    border: none;
                    cursor: pointer;
                }

                .error {
                    color: red;
                }

                .mensaje {
                    color: blue;
                    font-size: 1.2rem;
                }

                .enlinea {
                    display: inline-block;
                }
            </style>
        </head>

        <body>
            <h1>App Login SW</h1>
            <div>Bienvenido <strong><?php echo $datos_usuario_log->usuario ?></strong> -
                <form class="enlinea" action="index.php" method="post">
                    <button class="enlace" type="submit" name="btnSalir">Salir</button>
                </form>
            </div>
            <h2>Listado de Productos</h2>
            <?php
            if (isset($_POST["btnInsertar"]) || isset($_POST["btnContInsertar"])) {
                require "vistas/vista_insertar.php";
            } else if (isset($_POST["btnDetalles"])) {
                require "vistas/vista_detalles.php";
            } else if (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"])) {
                require "vistas/vista_editar.php";
            } else if (isset($_POST["btnBorrar"])) {
                require "vistas/vista_borrar.php";
            }
            if (isset($_SESSION["mensaje"])) {
                echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
                session_destroy();
            }
            ?>
            <table>
                <tr>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>PVP</th>
                    <th>
                        <form action="index.php" method="post"> <button class="enlace" type="submit" name="btnInsertar">Productos+</button></form>
                    </th>
                </tr>
                <?php
                require "vistas/vista_tabla.php";
                ?>
            </table>
        </body>

        </html>
    <?php
    }
} else {
    if (isset($_POST["btnLogin"])) {
        $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;
        $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 20;
        $error_form = $error_usuario || $error_clave;

        if (!$error_form) {
            $url = DIR_SERV . "/login";
            $datos = array("usuario" => $_POST["usuario"], "clave" => md5($_POST["clave"]));
            $respuesta = consumir_servicios_REST($url, "POST", $datos);
            $obj = json_decode($respuesta);
            if (!$obj) {
                session_destroy();
                die(error_page("ERROR", "<p>No has recibido un json </p>" . $respuesta));
            }

            if (isset($obj->mensaje_error)) {
                session_destroy();
                die(error_page("ERROR", "<p>" . $obj->mensaje_error . "</p>"));
            }

            if (isset($obj->mensaje)) {
                $error_usuario = true;
            } else {
                $_SESSION["usuario"] = $obj->usuario->usuario;
                $_SESSION["clave"] = $obj->usuario->clave;
                $_SESSION["ult_accion"] = time();
                header("Location: index.php");
                exit();
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Login SW</title>
        <style>
            .error {
                color: red;
            }

            .mensaje {
                color: blue;
                font-size: 1.2rem;
            }
        </style>
    </head>

    <body>
        <h1>App Lohin SW</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                <?php
                if (isset($_POST["usuario"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<span class='error'> Campo vacío.</span>";
                    else if (strlen($_POST["usuario"]) > 20)
                        echo "<span class='error'> Máximo 20 caracteres.</span>";
                    else
                        echo "<span class='error'> Usuario / clave no válidos.</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña: </label>
                <input type="password" name="clave" id="clave" maxlength="20">
                <?php
                if (isset($_POST["clave"]) && $error_clave) {
                    if ($_POST["clave"] == "")
                        echo "<span class='error'> Campo vacío.</span>";
                    else
                        echo "<span class='error'> Máximo 20 caracteres.</span>";
                }
                ?>
            </p>
            <p>
                <button type=" submit" name="btnLogin">Login</button>
            </p>
        </form>
        <?php
        if (isset($_SESSION["seguridad"])) {
            echo "<p class='mensaje'>" . $_SESSION["seguridad"] . "</p>";
            session_destroy();
        }
        ?>
    </body>

    </html>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">