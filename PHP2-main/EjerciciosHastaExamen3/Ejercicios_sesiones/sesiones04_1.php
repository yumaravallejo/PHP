<?php
session_name("sesiones04");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mover un punto a derecha e izquierda</title>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="center">MOVER UN PUNTO A DERECHA E IZQUIERDA</h1>
    <p>Haga clic en los botones para mover el punto: </p>
    <form action="sesiones04_2.php" method="post">
        <p>
            <button type="submit" name="accion" value="izq" style="line-height: 40px; font-size: 40px;">👈</button>
            <button type="submit" name="accion" value="der" style="line-height: 40px; font-size: 40px;">👉</button>
        </p>
        <p>
            <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="600px" height="20px" viewbox="-300 0 600 20">
                <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
                <circle cx="<?php if (isset($_SESSION["posicion"])) echo $_SESSION["posicion"]; else "0" ?>" cy="10" r="8" fill="red" />
            </svg>
        </p>
        <p><button type="submit" name="accion" value="0">Volver al centro</button></p>
    </form>
</body>

</html>