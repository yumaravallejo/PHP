<!-- Siempre hay que poner sesion start al principio del todo -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de sesiones</title>
</head>
<body>
    <h1>Teoría de Sesiones</h1>
    <?php
    if (!isset($_SESSION["nombre"])) {
        $_SESSION["nombre"] = "Nerea López";
        $_SESSION["clave"] = md5("123456");
    }
    ?>
    <p><a href="recibido.php">Ver datos</a></p>
    <form action="recibido.php" method="post">
        <button type="submit" name="btnBorrarSesion" >Borrar datos Sesión</button>
    </form>
</body>
</html>