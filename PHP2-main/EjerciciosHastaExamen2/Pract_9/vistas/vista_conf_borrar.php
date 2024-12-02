<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar</title>
</head>

<body>
    <form action="index.php" method="post">
        <p>Se dispone usted a borrar la película con id: <?php echo $_POST["btnBorrar"] ?> </p>
        <p>
            <input type="hidden" name="foto" value="<?php echo $_POST["foto"] ?>">
            <button type="submit" name="btnContBorrar" value="<?php echo $_POST["btnBorrar"] ?>">Continuar</button>
            <button type="submit" name="btnVolver" >Atrás</button>
        </p>
    </form>
</body>

</html>