<?php
session_name("libreria_exam");
session_start();
require "src/funciones.php";

if (isset($_POST['btnCerrarSesion'])) {
    session_destroy();
    header("Location: index.php");
}

try {
    $consulta = "SELECT * from libros";
    $libros = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die("No se ha podido realizar la consulta en la BD ".$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
    <style>
        ol {list-style-type: none; display: flex; flex-flow: row wrap; row-gap: 3rem; padding: 0; }
        li {flex-basis: 33%; text-align: center; align-items: center; padding-left: 0;}
        img {width: 50%; border: 1px solid black;}
        .enlace {text-decoration: underline; border: none; background-color: white; color: blue;}
        button {cursor: pointer;}
    </style>
</head>
<body>
    <?php 
        if (isset($_SESSION['usuario'])) {
            $salto = "index.php";
            
            //Control de baneo
            require "src/seguridad.php";

            if ($datos_usuario_logueado['tipo'] == "normal") {
                require "vistas/vista_normal.php";
            } else {
                header("Location: admin/gest_libros.php");
                mysqli_close($conexion);
                exit;
            }
            mysqli_close($conexion);
        } else {
            require "vistas/vista_login.php";
        }
        mysqli_free_result($libros);
    ?>
</body>
</html>