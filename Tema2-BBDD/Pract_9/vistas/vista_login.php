<?php

if (isset($_POST['btnLogin'])) {
    $error_usuario = $_POST['usuario'] == "";
    $error_clave = $_POST['clave'] == "";
    $errores_form_login = $error_usuario || $error_clave;
    if (!$errores_form_login) {
        //Consulta la BD y si está inicio sesión salto a index
        try {
            @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion ,"utf8");
        } catch(Exception $e) {
            session_destroy();
            die(error_page("Login", "<p>No se ha podido acceder a la base de datos: ".$e->getMessage()."</p>"));
        }

        //Conexión correcta, seguimos
        try {
            $consulta = "select usuario from usuarios where usuario='".$_POST['usuario']."' AND clave = '".md5($_POST['clave'])."' ";
            $result_select = mysqli_query ($conexion, $consulta);
            $n_tuplas = mysqli_num_rows($result_select);
            mysqli_free_result($result_select);
            if($n_tuplas>0){
                mysqli_close($conexion);
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['clave'] = md5($_POST['clave']);
                $_SESSION['ultm_accion'] = time();
                header("Location:index.php");
                exit;
            } else {
                $error_usuario = true;
                
            }
        } catch(Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die (error_page("Primer Login" , "<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
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
        .error{color:red}
        .mensaje{color:blue;font-size:1.25rem}
    </style>
</head>
<body>
<h1>Login</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'];?>" id="ususario">
            <?php 
                if (isset($_POST['btnLogin']) && $errores_form_login) {
                    if ($_POST['usuario'] == "") {
                        echo "<span class='error'>* CAMPO VACÍO *</span>";
                    } else {
                        echo "<span class='error'>* Usuario y/o contraseña incorrectos *</span>";
                    }
                }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="text" name="clave" value="<?php if (isset($_POST['clave'])) echo $_POST['clave'];?>" id="clave">
            <?php 
                if (isset($_POST['btnLogin']) && $errores_form_login) {
                    if ($_POST['clave'] == "") {
                        echo "<span class='error'>* CAMPO VACÍO *</span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Iniciar Sesión</button>
        </p>
    </form>
    <?php
        if(isset($_SESSION["msj_seguridad"]))
        {
            echo "<p class='mensaje'>".$_SESSION["msj_seguridad"]."</p>";
            session_destroy();
        }
    ?>
    </body>
</html>