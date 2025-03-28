<?php
if (isset($_POST['btnLogin'])) 
{
    $error_usuario = $_POST['usuario'] == "";
    $error_clave = $_POST['clave'] == "";
    $errores_form = $error_usuario || $error_clave;
    if (!$errores_form) 
    {
        $url = DIR_SERV . "/login";
        $datos_env['usuario'] = $_POST['usuario'];
        $datos_env['clave'] = md5($_POST['clave']);
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $json_usuario = json_decode($respuesta, true);

        if(!$json_usuario)
       {
            session_destroy();
            die(error_page("Actividad 8 - SW","<p>Error consumiendo el servicio Rest: <strong>".$url."</strong></p>"));
       }
       if(isset($json_usuario["error"]))
       {
            session_destroy();
            die(error_page("Actividad 8 - SW","<p>".$json_usuario["error"]."</p>"));
       }

       if(isset($json_usuario["mensaje"]))
       {
            $error_usuario=true;
       }
       else
       {
            $_SESSION["token"]=$json_usuario["token"];
            $_SESSION["ult_acc"]=time();
            header("Location:index.php");
            exit;
       }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {
            color: red
        }

        .mensaje {
            color: blue;
            font-size: 1.25rem
        }
    </style>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
            <?php
            if (isset($_POST['btnLogin']) && $error_usuario) {
                if($_POST["usuario"]=="")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>

        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave" value="<?php if (isset($_POST['clave'])) echo $_POST['clave'] ?>">
            <?php
            if (isset($_POST['btnLogin']) && $error_clave) {
                if (isset($_POST['clave']) == "")
                    echo "<span class='error'>Rellena este campo</span>";
                else
                    echo "<span class='error'>El usuario o la contraseña no coinciden</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>
    <?php
    if (isset($_SESSION["mensaje"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
        session_unset();
    }
    ?>
</body>

</html>