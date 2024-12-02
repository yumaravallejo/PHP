<?php
    session_name("sesiones03");
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="center">SUBIR Y BAJAR NÚMERO</h1>
    <p>Haga clic en los botones para modificar el valor: </p>
    <form action="sesiones03_2.php" method="post">
    <p>
        <button type="submit" name="btnContador" value="-">-</button>
        <span><?php if (isset($_SESSION["contador"])) echo $_SESSION["contador"]; else "0" ?></span>
        <button type="submit" name="btnContador" value="+">+</button>
    </p>
    <p><button type="submit" name="btnContador" value="0">Poner a cero</button></p>
    </form>
</body>
</html>