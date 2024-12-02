<?php
session_name("Practica10");
session_start();
require "../src/funciones.php";

if (isset($_POST['btnCerrarSesion'])) {
    session_destroy();
    $_SESSION['mensaje'] = "<p class='mensaje'>Se ha cerrado la sesión</p>";
    header("Location: ../index.php");
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
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 0.5rem;
        }

        th {
            background-color: lightgray;
            padding: .2rem
        }

        .enlace {
            background-color: white;
            border: none;
            color: blue;
            text-decoration: underline;
        }

        .error {
            color: red
        }

        button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p class='mensaje'>" . $_SESSION['mensaje'] . "<p>";
        session_destroy();
    }
    
    if (isset($_SESSION['usuario'])) {
        $salto = "../index.php";
        require "../src/seguridad.php";

        if ($datos_usuario_logueado['tipo'] == "admin") {
            require "../vistas/vista_admin.php";
        } else {
            header("Location:../index.php");
            exit;
        }
    } else {
        header("Location:../index.php");
        exit;
    }
    ?>
</body>

</html>