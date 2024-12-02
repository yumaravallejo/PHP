<?php
session_name("sesiones01");
session_start();

if (isset($_POST["nombre"])) {
    if ($_POST["nombre"] != "")
        $_SESSION["nombre"] = $_POST["nombre"];
    else
        unset($_SESSION("nombre"));
}

if (isset($_POST["btnBorrar"])) {
    session_destroy();
    header("Location: sesiones01_1.php");
    exit();
}
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
    <h1 class="center">FORMULARIO NOMBRE 1 (RESULTADO)</h1>
    <?php
    if (isset($_SESSION["nombre"]) && $_SESSION["nombre"] != "") {
        echo "Su nombre es: <strong>" . $_SESSION["nombre"] . "</strong>";
    } else {
        echo "<p>En la primera página no has tecleado nada.</p>";
    }
    ?>
    <p><a href="sesiones01_1.php">Volver a la primera página.</a></p>
</body>

</html>