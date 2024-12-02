<?php
require "src/ctes_func.php";
//redireccionamiento
if (isset($_POST["btnVolver"])) {
    header("Location:index.php");
    exit;
}

if (isset($_POST["btnContRegistro"])) {

    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 50;
    if (!$error_usuario) {

        $conexion = conectarBD_error_page();

        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);

        if (is_string($error_usuario)) {
            mysqli_close($conexion);

            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    }

    //CLAVE****, sea vacia o no sea igual a clave2

    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 15 || $_POST["clave"] != $_POST["clave2"];
    $dni_may = strtoupper($_POST["dni"]);
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($dni_may) || !dni_valido($dni_may);
    if (!$error_dni) {

        if (!isset($conexion)) {
            $conexion = conectarBD_error_page();
        }


        $error_dni = repetido($conexion, "usuarios", "dni", $dni_may);

        if (is_string($error_dni)) {
            mysqli_close($conexion);

            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No ha podido realizarse la consulta: " . $error_dni . "</p>"));
        }
    }


    $error_email = $_POST["email"] == ""
        || strlen($_POST["email"]) > 15
        || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$error_email) {
        //ya estoy conectada
        if (!isset($conexion)) {
            $conexion = conectarBD_error_page();
        }
        // $conexion,$tabla,$columna,$valor,$columna_clave=null,$valor_clave=null)
        $error_email = repetido($conexion, "usuarios", "email", $_POST["email"]);

        if (is_string($error_email)) {
            mysqli_close($conexion);

            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $error_email . "</p>"));
        }
    }

    $error_telefono = $_POST["telefono"] == "" || strlen($_POST["telefono"]) > 9 || !is_numeric($_POST["telefono"]);

    $error_form = $error_usuario || $error_clave || $error_dni || $error_email || $error_telefono;
    if (!$error_form) {

        var_dump("No hay errores");
        if (!isset($conexion)) {
            $conexion = conectarBD_error_page();
        }

        //inserto e inicio sesión y salto.
        //Inserto base de datos
        try {
            $consulta = "insert into usuarios (DNI, usuario, clave, telefono, email) 
            values ('" . $dni_may . "','" . $_POST["usuario"] . "','" . md5($_POST["clave"]) . "','" . $_POST["telefono"] . "','" . $_POST["email"] . "')";
            mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            // session_destroy(); no me hace falta en esta parte de cdigo
            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }

        session_name("Ex3_17_18_2");
        session_start();
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["clave"] = md5($_POST["clave"]);
        $_SESSION["ultima_accion"] = time();
        mysqli_close($conexion);
        header("Location:index.php");
        exit;
    }
}

if (isset($conexion)) {
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen3_17_18</title>
</head>

<body>
    <h1>Registro Video Club</h1>
    <!-- Esta puesto en una tabla -->
    <form action="registro_usuario.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" name="usuario" id="usuario" maxlength="15" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["usuario"]) > 50)
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                else
                    echo "<span class='error'> Usuario repetido</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave" maxlength="15">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["clave"]) > 15)
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                else
                    echo "<span class='error'>No has repetido bien la contraseña</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave2">Repita la contraseña:</label>
            <input type="password" name="clave2" id="clave2" maxlength="15">
            <!-- NO HAY ERRORES -->
        </p>


        <p>
            <label for="dni">DNI:</label>
            <input type="text" placeholder="DNI: 11223344Z" maxlength="9" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"]; ?>" />
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_dni) {
                if ($_POST["dni"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (!dni_bien_escrito($dni_may))
                    echo "<span class='error'> DNI no está bien escrito </span>";
                elseif (!dni_valido($dni_may))
                    echo "<span class='error'> DNI no válido </span>";
                else
                    echo "<span class='error'> DNI repetido </span>";
            }

            ?>
        </p>

        <p>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" maxlength="50" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_email) {
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
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" maxlength="15" value="<?php if (isset($_POST["telefono"])) echo $_POST["telefono"]; ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_telefono) {
                if ($_POST["telefono"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["telefono"]) > 9)
                    echo "<span class='error'> Has tecleado más de 9 caracteres</span>";
                else
                    echo "<span class='error'> No es un número</span>";
            }

            ?>
        </p>


        <p>
            <button type="submit" name="btnVolver" formaction="index.php">Volver</button>
            <button type="submit" name="btnContRegistro">Continuar</button>

        </p>



    </form>

</body>

</html>