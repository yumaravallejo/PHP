<?php
session_name("sesiones05");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mover un punto en dos dimensiones</title>
    <style>
        .center {
            text-align: center;
        }
        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        div.flex50 {
            flex: 0 50%;
        }
        p.flex button {
            margin: 1rem;
        }
    </style>
</head>

<body>
    <h1 class="center">MOVER UN PUNTO EN DOS DIMENSIONES</h1>
    <p>Haga clic en los botones para mover el punto: </p>
    <form action="sesiones05_2.php" method="post" class="flex">
        <div class="flex50 center">
            <p><button type="submit" name="accion" value="arr" style="line-height: 40px; font-size: 40px;">👆</button></p>
            <p class="flex"><button type="submit" name="accion" value="izq" style="line-height: 40px; font-size: 40px;">👈</button>
            <button type="submit" name="accion" value="0" style=" width: 70px; height: 50px;">Volver al centro</button>
            <button type="submit" name="accion" value="der" style="line-height: 40px; font-size: 40px;">👉</button></p>
            <p><button type="submit" name="accion" value="aba" style="line-height: 40px; font-size: 40px;">👇</button></p>
        </div>
        <div class="flex50">
            <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="400" height="400" viewBox="-200 -200 400 400">
                <rect x="-200" y="-200" width="400" height="400" stroke="black" fill="white" stroke-width="5" />
                <circle cx="<?php if (isset($_SESSION["posicionX"])) echo $_SESSION["posicionX"]; else "0" ?>" 
                            cy="<?php if (isset($_SESSION["posicionY"])) echo $_SESSION["posicionY"]; else "0" ?>" 
                            r="8" fill="red" />
            </svg>
        </div>
    </form>
</body>

</html>