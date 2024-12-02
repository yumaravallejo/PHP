<?php
session_name("ej2_SW");
session_start();
require "src/ctes_funciones.php";

if (isset($_POST["btnContInsertar"])) {
    require "vistas/vista_contInsertar.php";
}

if (isset($_POST["btnContEditar"])) {
    require "vistas/vista_contEditar.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Servicios Web</title>
    <style>
        th,
        tr,
        td,
        table {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .enlace {
            background: none;
            color: blue;
            text-decoration: underline;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .mensaje {
            color: blue;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <h1>Listado de Productos</h1>
    <?php
    if (isset($_POST["btnInsertar"]) || isset($_POST["btnContInsertar"])) {
        require "vistas/vista_insertar.php";
    } else if (isset($_POST["btnDetalles"])) {
        require "vistas/vista_detalles.php";
    } else if (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"])) {
        require "vistas/vista_editar.php";
    } else if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }
    if (isset($_SESSION["mensaje"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
        session_destroy();
    }
    ?>
    <table>
        <tr>
            <th>COD</th>
            <th>Nombre</th>
            <th>PVP</th>
            <th>
                <form action="index.php" method="post"> <button class="enlace" type="submit" name="btnInsertar">Productos+</button></form>
            </th>
        </tr>
        <?php
        require "vistas/vista_tabla.php";
        ?>
    </table>
</body>

</html>