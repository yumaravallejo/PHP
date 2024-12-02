<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Club</title>
    <style>
        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
        }
        th {
            background-color: #CCC;
        }
        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <p>
    <form action="index.php" method="post">
        Bienvenido <strong> <?php echo $datos_usuario_logueado["usuario"]  ?></strong> -
        <button type="submit" name="btnSalir" class="enlace">Salir</button>
    </form>
    </p>

</body>

</html>