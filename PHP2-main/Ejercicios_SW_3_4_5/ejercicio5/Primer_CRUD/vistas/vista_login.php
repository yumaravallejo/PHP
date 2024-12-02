<?php
if (isset($_POST["btnLogin"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_usuario || $error_clave;
    if (!$error_form) {
        // Comprobamos que existe

        $url = DIR_SERV . "/login";
        $datos = array("usuario" => $_POST["usuario"], "clave" => md5($_POST["clave"]));
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
        }

        if (isset($obj->error)) {
            session_destroy();
            die("<p>" . $obj->error . "</select></p></body></html>");
        }
        // Si está en la bd
        if (isset($obj->mensaje)) {
            $error_usuario = true;
        } else {
            $_SESSION["usuario"] = $obj->usuario->usuario;
            $_SESSION["clave"] = $obj->usuario->clave;
            $_SESSION["ult_acc"] = time();
            $_SESSION["api_key"] = $obj->api_key;
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
    <title>Ejercicio 5</title>
    <style>
        img {
            width: 100%;
            height: auto;
        }

        div#flex {
            display: flex;
            flex-flow: row wrap;
        }

        .flex33 {
            flex: 0 33%;
        }

        .flex33>p {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 5</h1>
    <form action="index.php" method="post">
        <table>
            <tr>
                <td>
                    <label for="usuario">Usuario:</label>
                </td>
                <td>
                    <input type="text" id="usuario" name="usuario" maxlength="15" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                    <?php
                    if (isset($_POST["btnLogin"]) && $error_usuario) {
                        if ($_POST["usuario"] == "")
                            echo "<span class='error'> Campo vacío.</span>";
                        else
                            echo "<span class='error'> Usuario/Contraseña no registrado en la BD.</span>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="clave">Contraseña:</label>
                </td>
                <td>
                    <input type="password" id="clave" maxlength="15" name="clave">
                    <?php
                    if (isset($_POST["btnLogin"]) && $error_clave) {
                        echo "<span class='error'> Campo vacío.</span>";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <br>
        <button type="submit" name="btnLogin">Entrar</button>
    </form>
    <?php
    if (isset($_SESSION["seguridad"])) {
        echo "<p class='error'>" . $_SESSION["seguridad"] . "</p>";
        session_destroy();
    }
    ?>
</body>

</html>