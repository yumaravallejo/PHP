<?php
session_start();
if (isset($_POST["btnBorrarSesion"])) {
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibido</title>
</head>

<body>
    <h1>Teoría de Sesiones</h1>
    <h2>Se ha recibido los siguientes datos:</h2>
    <p>
    <?php
    if (isset($_SESSION["nombre"])) {
    echo "<strong>Nombre: </strong>".$_SESSION["nombre"]."<br>";
    echo "<strong>Clave: </strong>".$_SESSION["clave"]."<br>";
    } else {
        echo "<p>Se han borrado los valores de la sesión</p>";
    }
    ?>
    </p>
    <p><a href="index.php">Volver</a></p>
    
</body>

</html>