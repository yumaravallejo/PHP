<?php
session_name("sesiones02");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Nombre 2</title>
    <style>
        .center {
            text-align: center;
        }
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1 class="center">FORMULARIO NOMBRE 2 (FORMULARIO)</h1>
    <?php
    if (isset($_SESSION["nombre"])) {
        echo "<p>Su nombre es: <strong>" . $_SESSION["nombre"] . "</strong></p>";
    }

    ?>
    <form action="sesiones02_2.php" method="post">
        <p><label for="nombre">Escriba su nombre: </label></p>
        <p>
            <strong>Nombre: </strong>
            <input type="text" name="nombre" id="nombre">
            <?php
            if (isset($_SESSION["error"])) {
                echo "<span class='error'>" . $_SESSION["error"] . "</span>";
                unset($_SESSION["error"]);
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnSig">Siguiente</button>
            <button type="submit" name="btnBorrar">Borrar</button>
        </p>
    </form>
</body>

</html>