<?php
session_name("sesiones06");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votar una opción</title>
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
    <h1 class="center">VOTAR UNA OPCIÓN</h1>
    <p>Haga clic en los botones para votar una opción: </p>
    <form action="sesiones06_2.php" method="post">
        <p><button type="submit" name="accion" value="1"><img src="Images/tick_azul.png" alt="Tick azul"/></button> <img src="Images/azul.png" alt="Tick azul" height="50px" width="<?php if(isset($_SESSION["azul"])) echo $_SESSION["azul"]; else echo "0" ?>px"/></p>
        <p><button type="submit" name="accion" value="2"><img src="Images/tick_naranja.png" alt="Tick naranja"/></button> <img src="Images/naranja.jpg" alt="Tick azul" height="50px" width="<?php if(isset($_SESSION["naranja"])) echo $_SESSION["naranja"]; else echo "0" ?>px"/></p>
        <p><button type="submit" name="accion">Poner a cero</button></p>
    </form>
</body>

</html>