<?php
//control de errores*****
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {

        $conexion = conectarBD();
        $consulta = "SELECT usuario FROM usuarios WHERE usuario='" . $_POST["usuario"] . "' and clave='" . md5($_POST["clave"]) . "'";
        echo $_POST["usuario"];
        echo $_POST["clave"];

        $resultado = consultarBD_error_page($conexion, $consulta);

        //si recojo tuplas
        if (mysqli_num_rows($resultado) > 0) {
            //nombro variables de session
            $_SESSION["usuario"] = $_POST["usuario"];
            $_SESSION["clave"] = md5($_POST["clave"]);
            $_SESSION["ultima_accion"] = time();
            mysqli_free_result($resultado);
            mysqli_close($conexion);
            header("Location:index.php");
            exit;
        } else {
            echo $_POST["usuario"];
            echo $_POST["clave"];

            //si no existe, EXISTE ERROR USER
            $error_usuario = true;
        }
        mysqli_free_result($resultado);
        mysqli_close($conexion);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen3_17_18</title>
    <style>
        .error {
            color: red
        }

        .mensaje {
            color: blue;
            font-size: 1.25em
        }
    </style>
</head>

<body>

    <h1>Video Club</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
            if (isset($_POST["btnEntrar"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                else
                    echo "<span class='error'> Usuario/Contraseña no registrado en BD </span>";
            }


            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["btnEntrar"]) && $error_clave)
                echo "<span class='error'> Campo vacío </span>";

            ?>
        </p>
        <p>
            <button type="submit" name="btnEntrar">Entrar</button>
            <button type="submit" name="btnRegistro" formaction="registro_usuario.php">Registrarse</button>

        </p>




    </form>
    <?php
    //Para la seguridad de la página
    if (isset($_SESSION["seguridad"])) {
        echo "<p class='mensaje'>" . $_SESSION["seguridad"] . "</p>";
        session_destroy();
    }
    ?>

</body>

</html>