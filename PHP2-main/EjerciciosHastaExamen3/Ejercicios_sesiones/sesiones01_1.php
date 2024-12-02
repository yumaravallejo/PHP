<?php
session_name("sesiones01");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Nombre 1</title>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="center">FORMULARIO NOMBRE 1 (FORMULARIO)</h1>
    <?php
    if (isset($_SESSION["nombre"])) {
        echo "Su nombre es: <strong>".$_SESSION["nombre"]."</strong>";
    }
    ?>
    <form action="sesiones01_2.php" method="post">
        <p><label for="nombre">Escriba su nombre: </label></p>
        <p>
            <strong>Nombre: </strong>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <button type="submit" name="btnSig">Siguiente</button>
            <button type="submit" name="btnBorrar">Borrar</button>
        </p>
    </form>
</body>

</html>