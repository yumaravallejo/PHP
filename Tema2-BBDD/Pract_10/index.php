<?php
session_name("Practica10");
session_start();
require "src/funciones.php";

if (isset($_POST['btnCerrarSesion'])) {
    session_destroy();
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        .error {color:red}
        .mensaje {color: blue; font-size: larger;}
        button {cursor: pointer;}

    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p class='mensaje'>".$_SESSION['mensaje']."<p>";
        session_destroy();
    }

    if (isset($_SESSION['usuario'])) {
        $salto = "index.php";
        require "src/seguridad.php";

        if ($datos_usuario_logueado['tipo'] == "normal") {
            require "vistas/vista_normal.php";
        } else {
            header("Location:admin/admin.php");
            mysqli_close($conexion);
            exit;
        }
        mysqli_close($conexion);
    } else {
        require "vistas/vista_login.php";
    }
    ?>
</body>

</html>