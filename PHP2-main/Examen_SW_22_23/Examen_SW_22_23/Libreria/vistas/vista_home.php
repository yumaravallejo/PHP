<?php
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 15;
    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 15;
    $error_form = $error_usuario || $error_clave;
    if (!$error_form) {
        $url = DIR_SER . "/login";
        $datos = array("lector" => $_POST["usuario"], "clave" => md5($_POST["clave"]));
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>"));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicio</title>
    <style>
        section {
            display: flex;
            justify-content: space-around;
            flex-flow: row wrap;
        }

        section>article {
            flex: 0 33%;
            text-align: center;
        }

        section>article>img {
            width: 100%;
            height: auto;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario: </label>
            <input type="text" name="usuario" id="usuario" maxlength="15" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["usuario"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class = 'error'> Campo vacío</span>";
                else
                    echo "<span class = 'error'> Número máximo de caracteres: 15</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave" maxlength="15">
            <?php
            if (isset($_POST["clave"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo "<span class = 'error'> Campo vacío</span>";
                else
                    echo "<span class = 'error'> Número máximo de caracteres: 15</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEntrar">Entrar</button>
        </p>
    </form>
    <h2>Listado de los Libros</h2>
    <section>
        <?php
        $url = DIR_SER . "/obtenerLibros";
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die("<p>Error consumiendo el servicio: " . $url . "</p></body></html>");
        }

        if (isset($obj->error)) {
            session_destroy();
            die("<p>Error: " . $obj->error . "</p></body></html>");
        }

        foreach ($obj->libros as $tupla) {
            echo '<article>
            <img src="images/' . $tupla->portada . '" alt="Portada del libro">
            <p>' . $tupla->titulo . ' - ' . $tupla->precio . '€</p>
        </article>';
        }
        ?>

    </section>
</body>

</html>