<?php

require "src/ctes_funciones.php";

if (isset($_POST["btnVolver"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["btnContRegistro"])) {
        $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 15;
        if (!$error_usuario) {
            try {
                $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
            }

            $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);

            if (is_string($error_usuario)) {
                mysqli_close($conexion);
                die($error_usuario);
            }
        }

        $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 15 || $_POST["clave"] != $_POST["clave2"];
        $error_dni = $_POST["dni"] == "" || strlen($_POST["dni"]) > 15 || !dni_bien_escrito(strtoupper($_POST['dni'])) ||
            !dni_valido($_POST['dni']);
        if (!$error_dni) {

            if (!isset($conexion)) {
                try {
                    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
                    mysqli_set_charset($conexion, "utf8");
                } catch (Exception $e) {
                    die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
                }
            }

            $error_dni = repetido($conexion, "usuarios", "dni", $_POST["dni"]);
            if (is_string($error_dni)){
                mysqli_close($conexion);
                die($error_dni);
            }
        }

        $error_email = $_POST["email"] == "" || strlen($_POST["email"]) > 15 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if (!$error_email) {
            if (!isset($conexion)) {
                try {
                    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
                    mysqli_set_charset($conexion, "utf8");
                } catch (Exception $e) {
                    die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
                }
            }
            $error_email = repetido($conexion, "usuarios", "email", $_POST["email"]);
            if (is_string($error_email)){
                mysqli_close($conexion);
                die($error_email);
            }
        }

        $error_telefono = $_POST["telefono"] == "" || strlen($_POST["telefono"]) > 15 || !is_numeric($_POST["telefono"]);
        
        $error_form = $error_usuario || $error_clave || $error_dni || $error_email || $error_telefono;

        if (!$error_form) {
            try {
                $consulta = "insert into usuarios (usuario, clave, DNI, email, telefono) values ('".$_POST["usuario"]."','".md5($_POST["clave"])."','".strtoupper($_POST["dni"])."','".$_POST["email"]."','".$_POST["telefono"]."')";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
            }

            session_name("Examen3_17_18");
            session_start();
            $_SESSION["usuario"] = $_POST["usuario"];
            $_SESSION["clave"] = md5($_POST["clave"]);
            $_SESSION["ultima_accion"]=time();
            mysqli_close($conexion);
            header("Location: index.php");
            exit();
        }

        if(isset($conexion))
            mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Club</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <form action="registro_usuario.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario: </label>
            <input type="text" id="usuario" name="usuario" maxlength="15" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo '<span class="error"> Campo vacío</span>';
                else
                    echo '<span class="error"> Usuario repetido</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" id="clave" name="clave">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo '<span class="error"> Campo vacío</span>';
                else if (strlen($_POST["clave"]) > 10) 
                    echo '<span class="error"> Has tecleado más de 10 caracteres</span>';
                else
                    echo '<span class="error"> Las contraseñas no coinciden</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave2">Repita la contraseña: </label>
            <input type="password" id="clave2" name="clave2">
        </p>
        <p>
            <label for="dni">DNI: </label>
            <input type="text" id="dni" name="dni" maxlength="15" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_dni) {
                if ($_POST['dni'] == '') {
                    echo "<span class='error'> Campo vacío </span>";
                } else if (!dni_bien_escrito(strtoupper($_POST['dni']))) {
                    echo "<span class='error'> DNI no está bien escrito </span>";
                } else if (!dni_valido($_POST['dni'])) {
                    echo "<span class='error'> DNI no válido </span>";
                } else {
                    echo "<span class='error'> DNI repetido </span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="text" id="email" name="email" maxlength="15" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_email) {
                if ($_POST["email"] == "")
                    echo '<span class="error"> Campo vacío</span>';
                else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    echo '<span class="error"> Email sintácticamente incorrecto</span>';
                } else
                    echo '<span class="error"> Email repetido</span>';
            }
            ?>
        </p>
        <p>
            <label for="telefono">telefono: </label>
            <input type="text" id="telefono" name="telefono" maxlength="9" value="<?php if (isset($_POST["telefono"])) echo $_POST["telefono"] ?>">
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_telefono) {
                if ($_POST["telefono"] == "")
                    echo '<span class="error"> Campo vacío</span>';
                else if (strlen($_POST["telefono"]) > 9) 
                    echo '<span class="error"> Has tecleado más de 9 digitos</span>';
                else
                    echo '<span class="error"> No es un número</span>';
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnVolver">Volver</button>
            <button type="submit" name="btnContRegistro">Continuar</button>
        </p>
    </form>
</body>

</html>